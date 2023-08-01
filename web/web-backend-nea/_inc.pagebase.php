<?php 

error_reporting(1);
ini_set('display_errors', 1);
$BASELINK = "/web-backend-nea";

/**
 * base
 */
session_start();

function redirectGetSelf(){
  global $BASELINK;
  header('Location: ' . $BASELINK, true, 302);
  die();
}

if($_REQUEST["logout"] != ""){
  $_SESSION = array();
  session_destroy();
  redirectGetSelf();
}

/**
 * is login 
 */
function generateHashPassword($argPass){
    $_postPass = trim($argPass);
    $_hashPass = hash('sha512', $_postPass);
    $_hashSalt = hash('sha256', $_hashPass);
    $hashMiddle = strlen($_hashSalt)/2;
    $hashFirst = trim(substr($_hashSalt, 0, $hashMiddle));
    $hashLast = trim(substr($_hashSalt, $hashMiddle));
    $_passSaltHash = $hashFirst . $_hashPass . $hashLast;
    $_hashPassSaltHash = hash('sha512', $_passSaltHash);

    return $_hashPassSaltHash;
}


$SESSNAME = md5(date("ymd") . session_id());
function checkLogin(){
  if(trim($_POST["username"]) != "" && trim($_POST["password"]) != "" && trim($_POST["loginform"]) == session_id()){
    global $DATABASE;

    $_postUser = strtolower(trim($_POST["username"]));
    $_hashPassSaltHash = generateHashPassword($_POST["password"]);

    $loginDbCheck = $DATABASE->webadmin_login($_postUser, $_hashPassSaltHash);
    if($loginDbCheck === $_hashPassSaltHash . "true"){
      define("ADM_LOGIN", true);
      $_SESSION["ADMINNAME"] = $_postUser;
      $_SESSION["ADMINHASH"] = $_hashPassSaltHash;
      return true;
    }else{
      define("ADM_LOGIN", false);    
      return false;
    }
  }
}

if($_SESSION["login"] != $SESSNAME){
  if(checkLogin()){
    $_SESSION["login"] = $SESSNAME;
    if($_SERVER['REQUEST_METHOD'] != 'GET'){
      echo '{"login":true}';
      exit;
    }else{
      redirectGetSelf();
    }
  }else{
    define("ADM_LOGIN", false);
    if($_SERVER['REQUEST_METHOD'] != 'GET'){
      echo '{"login":false}';
      exit;
    }
  }
}else{
  if($_SESSION["ADMINNAME"] != "" && $_SESSION["ADMINHASH"] != ""){
    define("ADM_LOGIN", true);
  }else{
    define("ADM_LOGIN", false);
  }
}

if(!ADM_LOGIN && $IS_INDEX_OR_LOGIN_PAGE != "indexlogin"){
  header('Location: ' . $BASELINK, true, 302);
  die();
}