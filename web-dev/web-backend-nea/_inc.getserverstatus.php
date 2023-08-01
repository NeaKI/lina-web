<?php 
@session_start();

if(!ADM_LOGIN || $_SESSION["ADMINNAME"] == ""){
  exit();
}

$SERVERS = [];
$SERVERS[] = "45.67.221.30";
$SERVERS[] = "45.88.223.172";
$SERVERS[] = "185.239.208.38";
$SERVERS[] = "185.239.208.39";
$SERVERS[] = "185.194.216.15";

$UUID = uniqid();


$SERVERSTATUS = [];

foreach($SERVERS as $key => $server) {
  try{
    $SERVERSTATUS[$server] = json_decode(file_get_contents("http://".$server.":90/?uuid=".$UUID."&randnum=".$_REQUEST["randnum"]), true);
  }catch(Exception $ex){}
  $SERVERSTATUS[$server]["server"]["xuuid"] = $UUID;
  $SERVERSTATUS[$server]["server"]["xrandnum"] = $_REQUEST["randnum"];
  $SERVERSTATUS[$server]["server"]["connect"] = ($_REQUEST["randnum"] == $SERVERSTATUS[$server]["server"]["randnum"] && $UUID == $SERVERSTATUS[$server]["server"]["uuid"] ) ? true : false;
}

echo json_encode($SERVERSTATUS);
