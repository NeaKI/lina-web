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



$SERVERSTATUS = [];

foreach($SERVERS as $key => $server) {
  try{
    $SERVERSTATUS[$server] = json_decode(file_get_contents("http://".$server.":90"), true);
  }catch(Exception $ex){}
}

echo json_encode($SERVERSTATUS);
