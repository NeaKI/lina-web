<?php
class RequestHandle {
  
  public static $SECHASH;

    function __construct() {
      self::loadWithoutIndexPhp();
      self::secureHashGenerator();
      self::responseHeadRequest();
      self::formRequest();
    }

    function dieHeader(string $argText = "") {
      #header("HTTP/1.1 401 Unauthorized");
      header("HTTP/1.1 428 Precondition Required");
      header('NEA-SND-HSH: ' . self::$SECHASH);
      die(json_encode($argText));
    }

    function loadWithoutIndexPhp(){
      if(substr_count($_SERVER["REQUEST_URI"], "/index.php") >= 1){
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $thisPath = dirname($_SERVER['REQUEST_URI']);
        $onlyPath = str_replace($rootPath, '', $thisPath) . "/";
        header("Location: " . $onlyPath, true, 301);
        exit;
      }
    }

    function responseHeadRequest() {
      if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        if(isset($_POST["NEA-REQ-SRV"]) && isset($_POST["NEA-SEC-HSH"]) && isset($_POST["NEA-REQ-FRM"])){
          if($_POST["NEA-REQ-FRM"] == "NEA-SND-FRM"){ return true; }
          if($_POST["NEA-REQ-FRM"] != "NEA-GET-HSH"){ self::dieHeader(); }
          if($_POST["NEA-SEC-HSH"] != session_id() && $_POST["NEA-REQ-SRV"] != "dev.lina-narzisse.de"){ self::dieHeader(); }
          if($_POST["NEA-REQ-SRV"] != $_SERVER["HTTP_HOST"] && $_POST["NEA-REQ-SRV"] != "dev.lina-narzisse.de"){ self::dieHeader(); }
          header("NEA-SND-HSH: " . self::$SECHASH);
          die();
        }
      }else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          /* continue */
      }else{
        self::dieHeader("HTTP REQUEST METHOD ERROR: " . $_SERVER['REQUEST_METHOD']);
      }
    }

    function formRequest() {
      if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        if(isset($_POST["NEA-REQ-SRV"]) && isset($_POST["NEA-SEC-HSH"]) && isset($_POST["NEA-REQ-FRM"])){
          if($_POST["NEA-REQ-FRM"] != "NEA-SND-FRM"){ self::dieHeader(); }
          if($_POST["NEA-SEC-HSH"] != self::$SECHASH && $_POST["NEA-REQ-SRV"] != "dev.lina-narzisse.de"){ self::dieHeader(); }
          if($_POST["NEA-REQ-SRV"] != $_SERVER["HTTP_HOST"] && $_POST["NEA-REQ-SRV"] != "dev.lina-narzisse.de"){ self::dieHeader(); }

          if(hash('sha256', $_SERVER["REQUEST_URI"]) != $_POST["NEA-FRM-PAG"]){
            if($_SESSION["login"] == session_id()){
              self::dieHeader("ERROR NEA-FRM-PAG: Incorrect post URL");
            }
          }

            /* continue */
        }else{
          self::dieHeader("METHOD-ERROR: formRequest");
        }
      }else{
        /* continue */
      }
    }

    function secureHashGenerator() {
      @session_start();

      $_keys = [];
      $_keys["HTTP_ACCEPT_ENCODING"] = $_SERVER["HTTP_ACCEPT_ENCODING"];
      $_keys["HTTP_ACCEPT"] = $_SERVER["HTTP_ACCEPT"];
      $_keys["HTTP_USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"];
      $_keys["GEOIP_POSTAL_CODE"] = $_SERVER["GEOIP_POSTAL_CODE"];
      $_keys["GEOIP_LONGITUDE"] = $_SERVER["GEOIP_LONGITUDE"];
      $_keys["GEOIP_LATITUDE"] = $_SERVER["GEOIP_LATITUDE"];
      $_keys["GEOIP_CITY"] = $_SERVER["GEOIP_CITY"];
      $_keys["REGION_NAME"] = $_SERVER["REGION_NAME"];
      $_keys["GEOIP_COUNTRY_NAME"] = $_SERVER["GEOIP_COUNTRY_NAME"];
      $_keys["GEOIP_ADDR"] = $_SERVER["GEOIP_ADDR"];
      $_keys["REMOTE_PORT"] = $_SERVER["REMOTE_PORT"];
      $_keys["SESSION_ID"] = session_id();

      $_keysString = "";
      foreach ($_keys as $key => $value) {
        $_keysString .= $key.$value;
      }

      $hash = hash('sha512', $_keysString);
      self::$SECHASH = $hash;
    }

    function getSecureHash() {
      return self::$SECHASH;
    }
}

define("REQUESTHANDLE", new RequestHandle());
