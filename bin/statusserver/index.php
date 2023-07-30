<?php

$DATA = [];


$DATA["server"]["network"]["ip"] = trim(shell_exec('echo $(ip addr list eth0) | grep "inet " | cut -d" " -f23 | cut -d/ -f1'));

$DATA["server"]["system"]["date"] = trim(shell_exec('date'));

$DATA["server"]["uptime"]["pretty"] = trim(shell_exec('uptime -p'));
$DATA["server"]["uptime"]["since"] = trim(shell_exec('uptime -s'));

$DATA["server"]["cpu"]["percent"] = (float)trim(shell_exec("grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage}'"));



echo json_encode($DATA);
exit;