<?php

$DATA = [];


  $DATA["server"]["uuid"] = $_REQUEST["uuid"];
  $DATA["server"]["randnum"] = $_REQUEST["randnum"];

  $DATA["server"]["network"]["ip"] = trim(shell_exec('echo $(ip addr list eth0) | grep "inet " | cut -d" " -f23 | cut -d/ -f1'));

  $DATA["server"]["system"]["date"] = trim(shell_exec('date'));
  $DATA["server"]["system"]["dateformat"] = trim(shell_exec('date "+%Y-%m-%d %H:%M:%S"'));

  $DATA["server"]["load"]["1"] = trim(shell_exec('cat /proc/loadavg | cut -d " " -f1'));
  $DATA["server"]["load"]["5"] = trim(shell_exec('cat /proc/loadavg | cut -d " " -f2'));
  $DATA["server"]["load"]["15"] = trim(shell_exec('cat /proc/loadavg | cut -d " " -f3'));

  $DATA["server"]["memory"]["percentfree"] = trim(shell_exec("free -b | awk 'NR == 2 {printf(\"%.2f\"), $4/$2*100}'"));
  $DATA["server"]["memory"]["total"] = trim(shell_exec("free -b | awk 'NR == 2 {printf $2/1024/1024/1024}'"));
  $DATA["server"]["memory"]["free"] = trim(shell_exec("free -b | awk 'NR == 2 {printf $4/1024/1024/1024}'"));

  $DATA["server"]["uptime"]["pretty"] = trim(shell_exec('uptime -p'));
  $DATA["server"]["uptime"]["since"] = trim(shell_exec('uptime -s'));

  $DATA["server"]["cpu"]["percent"] = (float)trim(shell_exec("ps aux | awk {'sum+=$3;print sum'} | tail -n 1"));
  $DATA["server"]["cpu"]["cores"] = (float)trim(shell_exec("cat /proc/cpuinfo |grep 'processor'|wc -l "));
  $DATA["server"]["cpu"]["percent"] /= $DATA["server"]["cpu"]["cores"];
  #$DATA["server"]["cpu"]["speed"] = trim(shell_exec("dmidecode --type processor | grep 'Current Speed:' | cut -d':' -f2"));
  $DATA["server"]["cpu"]["speed"] = (int)trim(shell_exec("cat /proc/cpuinfo | grep -i mhz | uniq | cut -d ':' -f2"));
  $DATA["server"]["cpu"]["corespeed"] = $DATA["server"]["cpu"]["cores"] . " Core x " . $DATA["server"]["cpu"]["speed"] . " MHz";


  $DATA["server"]["hdd"]["free"] = (float)trim(shell_exec("df | grep '/dev/sda3' | awk '{print $4/1024/1024}'"));

  $DATA["server"]["loadpercent"]["1"] = ($DATA["server"]["load"]["1"] * 100) / $DATA["server"]["cpu"]["cores"];
  $DATA["server"]["loadpercent"]["5"] = ($DATA["server"]["load"]["5"] * 100) / $DATA["server"]["cpu"]["cores"];
  $DATA["server"]["loadpercent"]["15"] = ($DATA["server"]["load"]["15"] * 100) / $DATA["server"]["cpu"]["cores"];

  try {
    $DATA["server"]["webroute"] = trim(file_get_contents(__DIR__ . "/../../log/iptables.webserver.ip.log"));
  }catch(Exception $ex){}



  ##### 
  $portTime = trim(shell_exec("nmap --host-timeout 1s -sS -Pn -n -p 22,53,80,90,443,3306,8080 -d3 127.0.0.1 | grep 'RCVD' | grep 'SA seq' | awk {'print $2,$4'} | sed 's/(//g' | sed 's/s) \[127.0.0.1:/|/g' | tr '\n' ';'"));
  $portTimeExp = explode(";", $portTime);
  foreach ($portTimeExp as $key => $value) {
    $valueExp = explode("|", $value);
    if($valueExp[1] <= 0){ continue; }
        $DATA["server"]["service"][$valueExp[1]]["time"] = (float)$valueExp[0];
  }

  $DATA["server"]["service"]["22"]["count"] = (int)trim(shell_exec('lsof -i TCP:22 | grep "sshd" | wc -l'));
  $DATA["server"]["service"]["53"]["count"] = (int)trim(shell_exec('lsof -i TCP:53 | grep "named" | wc -l'));
  $DATA["server"]["service"]["80"]["count"] = (int)trim(shell_exec('lsof -i TCP:80 | grep "www-data" | wc -l'));
  $DATA["server"]["service"]["90"]["count"] = (int)trim(shell_exec('lsof -i TCP:90 | grep ":90" | wc -l'));
  $DATA["server"]["service"]["443"]["count"] = (int)trim(shell_exec('lsof -i TCP:443 | grep "www-data" | wc -l'));
  $DATA["server"]["service"]["3306"]["count"] = (int)trim(shell_exec('lsof -i TCP:3306 | grep "mysql" | wc -l'));
  $DATA["server"]["service"]["8080"]["count"] = (int)trim(shell_exec('lsof -i TCP:8080 | grep "www-data" | wc -l'));
  


echo json_encode($DATA);
exit; 
