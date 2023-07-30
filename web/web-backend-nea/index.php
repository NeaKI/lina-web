<?php 
$IS_INDEX_OR_LOGIN_PAGE = "indexlogin";
require_once(__DIR__ . "/_inc.header.php");
$requestFileFound = false;

/* login */
if(!$requestFileFound && !ADM_LOGIN){
  $requestFileFound = true;
  require_once(__DIR__ . "/content/login/login.php");
}

/* index */
if(!$requestFileFound){
  $requestFileFound = true;
  require_once(__DIR__ . "/content/dashboard/dashboard.php");
}

/* eof page */
require_once(__DIR__ . "/_inc.footer.php");
require_once(__DIR__ . "/../assets/php/phpquery.php");
