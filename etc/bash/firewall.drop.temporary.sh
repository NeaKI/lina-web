#!/bin/bash
NEA_FW_DIRNAME=$(dirname "$0");
BinIpTables=$(which iptables);
NeawolfIpFile=$(cat /neawolf/firewall/neawolf.ip);

NEA_FW_DROP_PERMANENT="${NEA_FW_DIRNAME}/../../firewall/drop/permanent";
NEA_FW_DROP_TEMPORARY="${NEA_FW_DIRNAME}/../../firewall/drop/temporary";

IP_Firewall_1="45.67.221.30";
IP_Firewall_2="45.88.223.172";
IP_Webserver_1="185.239.208.38";
IP_Webserver_2="185.239.208.39";
IP_Database_1="185.194.216.15";





restoreFirewallRules() {
  $(which iptables-save) | grep -v "DROP-TEMPORARY-RULE:" | $(which iptables-restore);
}



readDirectory() {
  for f in $1/*.ip ; do 
    currFile=$(echo $f | awk -F"/" '{print $NF}');
    ip=${currFile//.ip/};

    if [[ $ip =~ ^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$ ]]; then

      if [[ "${NeawolfIpFile}" != "$ip" && "$ip" != "${IP_Firewall_1}" && "$ip" != "${IP_Firewall_2}" && "$ip" != "${IP_Webserver_1}" && "$ip" != "${IP_Webserver_2}" && "$ip" != "${IP_Database_1}" ]]; then
          echo "drop: $ip / ${NeawolfIpFile}";
          $BinIpTables -A INPUT -s ${ip} -j DROP -m comment --comment "DROP-TEMPORARY-RULE:${ip}";
      fi

    fi
  done
}




restoreFirewallRules;
readDirectory "${NEA_FW_DROP_TEMPORARY}";
