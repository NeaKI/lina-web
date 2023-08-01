<?php 
require_once(__DIR__ . "/_inc.pagebase.php");
ob_start("sanitize_output");

$templatePath = __DIR__ . "/template/view";
$controllerPath = __DIR__ . "/template/controller";
$baseClassPath = __DIR__ . "/template/base";
$requestFileFound = false;


/* template files */
  $REQUEST_FILE = $_SERVER["REQUEST_URI"];
  $REQUEST_FILE = explode("?", $REQUEST_FILE);
  $REQUEST_FILE = $REQUEST_FILE[0];
  $REQUEST_FILE = explode("#", $REQUEST_FILE);
  $REQUEST_FILE = trim($REQUEST_FILE[0]);

  if($REQUEST_FILE == ""){
    $REQUEST_FILE = "/index.php";
  }
  if($REQUEST_FILE == "/" || substr($REQUEST_FILE, -1) == "/"){
    $REQUEST_FILE .= "index.php";
  }

  $TPLFILE = $REQUEST_FILE;
  if(substr($TPLFILE, -5) == ".html"){
    $TPLFILE = substr($TPLFILE, 0, -5) . ".tpl";
  }
  if(substr($TPLFILE, -4) == ".php"){
    $TPLFILE = substr($TPLFILE, 0, -4) . ".tpl";
  }

  $argTemplateFile = $templatePath . $TPLFILE;
  if(!is_file($argTemplateFile) && is_file($argTemplateFile) . "/index.tpl"){
    $argTemplateFile .= "/index.tpl";
  }

  if(!$requestFileFound && is_file($argTemplateFile)){
    require_once($baseClassPath . "/base.php");
    $_TPLBASE = new TPLBASE_BASE($argTemplateFile);
    if(is_file($controllerPath . $REQUEST_FILE)){
      require_once($controllerPath . $REQUEST_FILE);
      $_CONTROLLER = new TemplateController();
    }
    $requestFileFound = true;
  }
/* template files */


/* error 404 */
if(!$requestFileFound){
          header("HTTP/1.1 200 OK", true);
        header("Status: 200 OK", true);
  require_once($baseClassPath . "/base.php");
  $_TPLBASE = new TPLBASE_BASE($templatePath . "/error/404.tpl");
  if(is_file($controllerPath . $REQUEST_FILE)){
    require_once($controllerPath . $REQUEST_FILE);
    $_CONTROLLER = new TemplateController();
  }
  $requestFileFound = true;
}

require_once(__DIR__ . "/assets/php/phpquery.php");
print_r($_SERVER);

#print_r($controllerPath . $REQUEST_FILE);
#print_r($argTemplateFile);
#print_r($templatePath . "/error/error.tpl");