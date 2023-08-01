<?php 

#require_once __DIR__ . "/phpquery/phpQuery-onefile.php";
require_once __DIR__ . "/phpQuery/phpQuery.php";
$ouputcontent = ob_get_contents();
ob_end_clean();

$QUERYDOC = phpQuery::newDocument($ouputcontent);

/* mobile detect in meta */
$isPhone = $_MobileDetect->isMobile() && !$_MobileDetect->isTablet() ? "true" : "false";
$isTablet = $_MobileDetect->isTablet() ? "true" : "false";
$isMobile = $_MobileDetect->isMobile() ? "true" : "false";

$QUERYDOC->find('head')->append('<meta name="xdetect-ismobile" content="'.$isMobile.'" />');
$QUERYDOC->find('head')->append('<meta name="xdetect-istablet" content="'.$isTablet.'" />');
$QUERYDOC->find('head')->append('<meta name="xdetect-isphone" content="'.$isPhone.'" />');

$QUERYDOC->find('body')->append('<input type="hidden" name="neasecses" id="neasecses" value="'.session_id().'" />');

$QUERYDOC->find('form, input, select, textarea')->attr('autocomplete', "off");

$_CURRENT_WEBSERVER=$_SERVER["SERVER_ADDR"];
$_CURRENT_FIREWALL=$_SERVER["REMOTE_ADDR"];

$QUERYDOC->find('head')->append('<meta name="xdetect-webserver" content="'.$_CURRENT_WEBSERVER.'" />');
$QUERYDOC->find('head')->append('<meta name="xdetect-gateway" content="'.$_CURRENT_FIREWALL.'" />');

$QUERYDOC->find('head')->append('
  <script>
    var xdetect = {
      "ismobile" : "' . $isMobile . '",
      "istablet" : "' . $isTablet . '",
      "isphone" : "' . $isPhone . '",
      "webserver" : "' . $_CURRENT_WEBSERVER . '",
      "gateway" : "' . $_CURRENT_FIREWALL . '",
    }
  </script>
');

if($isPhone == "true") { $QUERYDOC->find('body')->addClass("isphone"); }
if($isTablet == "true") { $QUERYDOC->find('body')->addClass("istablet"); }
if($isMobile == "true") { $QUERYDOC->find('body')->addClass("ismobile"); }
if($isPhone != "true" && $isMobile != "true" && $isMobile != "true") { $QUERYDOC->find('body')->addClass("isdesktop"); }

/* smart link or full page */
if($_REQUEST["hrefsmartlink"] == "true"){
  $QUERYDOC = $QUERYDOC->find('#bodypage')->html();
  $ouputcontent = sanitize_output($QUERYDOC);
}else{
  $ouputcontent = sanitize_output($QUERYDOC);
}

/* smarty debug window */
$ouputcontent = str_replace('<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >', '<head><meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" >', $ouputcontent);

echo $ouputcontent;
