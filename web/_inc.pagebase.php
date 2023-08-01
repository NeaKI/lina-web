<?php
error_reporting(1);
ini_set('display_errors', 1);

ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 0);
ini_set("session.use_trans_sid", 0);
ini_set("session.cache_limiter", "");


header('Content-Type: text/html; charset=utf-8');

/* database */
require_once(__DIR__ . "/assets/sql/pdo.inc.php");
require_once(__DIR__ . "/assets/php/request-handle.php");
require_once(__DIR__ . "/assets/php/firewall.php");

/* less */
require_once(__DIR__ . "/assets/php/lessc.inc.php");
$lessCss = new lessc;
$lessCss->checkedCompile(__DIR__ . "/assets/css/_toCombine.css", __DIR__ . "/assets/css/_combine1.css");

$lessCssInFile = $lessCss->compileFile(__DIR__ . "/assets/less/style.less");
if(!is_file(__DIR__ . "/assets/css/less.css") || (md5($lessCssInFile) != md5(file_get_contents(__DIR__ . "/assets/css/less.css")))){
  try{
    unlink(__DIR__ . "/assets/css/less.css");
  }catch(Exception $ex){}
  file_put_contents(__DIR__ . "/assets/css/less.css", $lessCssInFile);
}


/* js compress */
$miniJsInFile = "";
foreach(glob(__DIR__ . "/assets/js/website/*.js") AS $jsFile){
  $miniJsInFile .= file_get_contents($jsFile) . ";" . PHP_EOL;
}
if(md5($miniJsInFile) != md5(file_get_contents(__DIR__ . "/assets/js/compress.org.js"))){
  file_put_contents(__DIR__ . "/assets/js/compress.org.js", $miniJsInFile);
  file_put_contents(__DIR__ . "/assets/js/compress.minify.js", $miniJsInFile);

    try {
      require_once(__DIR__ . "/assets/php/JShrink.php");
      $minifiedCode = \JShrink\Minifier::minify($miniJsInFile, array('flaggedComments' => false));
      file_put_contents(__DIR__ . "/assets/js/compress.squeeze.js", $minifiedCode);
    }catch(Exception $ex){}
}


/* array to object */
function recursiveConvertArrayToObj($arr) {
    if (is_array($arr)){
        $new_arr = array();
        foreach($arr as $k => $v) {
            if (is_integer($k)) {
                $new_arr['index'][$k] = recursiveConvertArrayToObj($v);
            }
            else {
                $new_arr[$k] = recursiveConvertArrayToObj($v);
            }
        }
        return (object) $new_arr;
    }
    return $arr; 
}


/* json configs */
$_JCONFIG = [];
function configJsonToArray(){
  global $_JCONFIG;
  foreach(glob(__DIR__ . "/config/*.json.php") AS $jsonFile){
    $json = file_get_contents($jsonFile);
    $json = strip_tags($json);
    $json = json_decode($json, true);
    $_JCONFIG = array_merge($json, $_JCONFIG);
  }
  return $_JCONFIG;
}
$JCONFIG = configJsonToArray();
$oJCONFIG = recursiveConvertArrayToObj($JCONFIG);



/* output compressor */
function sanitize_output($buffer) {

  $search = array(
      '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
      '/[^\S ]+\</s',     // strip whitespaces before tags, except space
      '/(\s)+/s',         // shorten multiple whitespace sequences
      '/<!--(.|\s)*?-->/' // Remove HTML comments
  );

  $replace = array(
      '>',
      '<',
      '\\1',
      ''
  );

  $buffer = preg_replace($search, $replace, $buffer);

  return $buffer;
}

function sanitize_output_json($buffer) {

  $search = array(
      '/{(.|\s)*?}/',
      '/var (.|\s)*?;/',
      '/& (.|\s)*?;/'
  );

  $replace = array(
      '',
      '',
      ''
  );

  $buffer = htmlspecialchars(preg_replace($search, $replace, $buffer));
  $buffer = str_replace("&nbsp;", "", $buffer);
  $buffer = preg_replace('/\s+/', ' ', $buffer);

  return $buffer;
}
  


/* mobile detect */
require_once(__DIR__ . "/assets/php/mobile-detect/Mobile_Detect.php");
$_MobileDetect = new Mobile_Detect;



/* host, url */
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
$_PATH_DOMAIN_PROTOCOL = siteURL();

$path_parts = pathinfo(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']));
$_PATH_DIR = $path_parts['dirname'];
$_PATH_BASE = $path_parts['basename'];
$_PATH_EXT = $path_parts['extension'];
$_PATH_EXT = explode("#", $_PATH_EXT);
$_PATH_EXT = $_PATH_EXT[0];
$_PATH_EXT = explode("?", $_PATH_EXT);
$_PATH_EXT = $_PATH_EXT[0];
$_PATH_FILE = $path_parts['filename'];
$_PATH_FILENAME = $path_parts['filename'] . "." . $_PATH_EXT;
$_PATH_FILENAME = explode("#", $_PATH_FILENAME);
$_PATH_FILENAME = $_PATH_FILENAME[0];
$_PATH_FILENAME = explode("?", $_PATH_FILENAME);
$_PATH_FILENAME = $_PATH_FILENAME[0];
if($_PATH_FILENAME == "" || $_PATH_FILENAME == "."){
  $_PATH_FILENAME = "index.php";
}
