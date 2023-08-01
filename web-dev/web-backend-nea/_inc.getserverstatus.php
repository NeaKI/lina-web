<?php 
require_once(__DIR__ . "/_inc.pagebase.php");
@session_start();

if($_SESSION["ADMINNAME"] == "" && $_SESSION["login"] == $SESSNAME){
  exit();
}

require __DIR__ . '/../vendor/autoload.php';
use Amp\Future;
use function Amp\async;

$UUID = uniqid();
$async = [];

$SERVERSTATUS = [];
$SERVERS = [];
$SERVERS[] = "45.67.221.30";
$SERVERS[] = "45.88.223.172";
$SERVERS[] = "185.239.208.38";
$SERVERS[] = "185.239.208.39";
$SERVERS[] = "185.194.216.15";


$forCount = 0;
foreach($SERVERS as $key) {
    global $key;

  $async[$key] = async(function () {
    global $forCount;
    global $UUID;
    global $SERVERSTATUS;
    global $SERVERS;
    $server = $SERVERS[$forCount++];

      try{
        $SERVERSTATUS[$server] = json_decode(file_get_contents("http://".$server.":90/?uuid=".$UUID."&randnum=".$_REQUEST["randnum"]), true);
      }catch(Exception $ex){
        $SERVERSTATUS[$server]["server"]["connect"] = false;
        $SERVERSTATUS[$server]["server"]["xuuid"] = false;
      }
      $SERVERSTATUS[$server]["server"]["xuuid"] = $UUID;
      $SERVERSTATUS[$server]["server"]["xrandnum"] = $_REQUEST["randnum"];
      $SERVERSTATUS[$server]["server"]["connect"] = ($_REQUEST["randnum"] == $SERVERSTATUS[$server]["server"]["randnum"] && $UUID == $SERVERSTATUS[$server]["server"]["uuid"] ) ? true : false;

  });
}


foreach($SERVERS as $key => $server) {
  $async[$server]->await();
};

echo json_encode($SERVERSTATUS);

