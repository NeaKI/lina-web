#!/bin/bash
NEA_SCRIPT_HEADER_NAME="Firewall";
NEA_FW_DIRNAME=$(dirname "$0");
source "${NEA_FW_DIRNAME}/header.sh";
NeawolfIpFile=$(cat /neawolf/firewall/neawolf.ip);
NeawolfIP="${NeawolfIpFile}/16"; ## diese permanent abfragen - zusätzlich die neawolf server freigeben, um remote zugreifen zu können und die lokale neawolf ip ändern zu können. ebenfalls alle admins aus dem backend eintragen
IP_Firewall_1="45.67.221.30";
IP_Firewall_2="45.88.223.172";
IP_Webserver_1="185.239.208.38";
IP_Webserver_2="185.239.208.39";
IP_Database_1="185.194.216.15";

NEA_FW_ALLOW_PERMANENT="${NEA_FW_DIRNAME}/../../firewall/allow/permanent";
NEA_FW_ALLOW_TEMPORARY="${NEA_FW_DIRNAME}/../../firewall/allow/temporary";
NEA_FW_DROP_PERMANENT="${NEA_FW_DIRNAME}/../../firewall/drop/permanent";
NEA_FW_DROP_TEMPORARY="${NEA_FW_DIRNAME}/../../firewall/drop/temporary";

#
#
#

LocalIP="$(ip addr list eth0 |grep "inet " |cut -d' ' -f6|cut -d/ -f1)"
BinIpTables=$(which iptables);
BinIpTablesSave=$(which iptables-save);

#
#
#

exportIpTablesRule() {
  ${BinIpTablesSave} > "${NEA_FW_DIRNAME}/../../log/iptables.$1.log";
}

readDirectory() {
  for f in $1/*.ip ; do 
    currFile=$(echo $f | awk -F"/" '{print $NF}');
    ip=${currFile//.ip/};

    if [[ $ip =~ ^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$ ]]; then
        echo "$2: $ip";
    fi
  done
}

setServerRule() {
  case $1 in

    $IP_Firewall_1 | $IP_Firewall_2)
        echo -n "Server: $1 Firewall Rule"
          #Setting default filter policy
          $BinIpTables -P INPUT DROP
          $BinIpTables -P OUTPUT ACCEPT
          $BinIpTables -P FORWARD ACCEPT

          #Allow unlimited traffic on loopback
          $BinIpTables -A INPUT -i lo -j ACCEPT
          $BinIpTables -A OUTPUT -o lo -j ACCEPT
          $BinIpTables -A FORWARD -o lo -j ACCEPT
          #Allow incoming ports ADMIN
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${NeawolfIP} -j ACCEPT

          #Allow incoming ports
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 53 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8080 -s ${NeawolfIP} -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8081 -s ${NeawolfIP} -j ACCEPT

          $BinIpTables -F -t nat
          $BinIpTables -t nat -A PREROUTING -s 0/0 -p tcp -d ${LocalIP} --dport 80 -j DNAT --to $IP_Webserver_1:80 -m comment --comment "WEBSERVER-FORWARD-RULE:80:${IP_Webserver_1}" 
          $BinIpTables -t nat -A PREROUTING -s 0/0 -p tcp -d ${LocalIP} --dport 443 -j DNAT --to $IP_Webserver_1:443 -m comment --comment "WEBSERVER-FORWARD-RULE:443:${IP_Webserver_1}"
          $BinIpTables -t nat -A POSTROUTING -j MASQUERADE
      ;;

    $IP_Webserver_1 | $IP_Webserver_2)
        echo -n "Server: $1 Webserver Rule"
          #Setting default filter policy
          $BinIpTables -P INPUT DROP
          $BinIpTables -P OUTPUT ACCEPT
          $BinIpTables -P FORWARD DROP

          #Allow unlimited traffic on loopback
          $BinIpTables -A INPUT -i lo -j ACCEPT
          $BinIpTables -A OUTPUT -o lo -j ACCEPT
          $BinIpTables -A FORWARD -o lo -j ACCEPT
          #Allow incoming ports ADMIN
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${NeawolfIP} -j ACCEPT

          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Firewall_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Firewall_2 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Firewall_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Firewall_2 -j ACCEPT

          #/sbin/iptables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8080 -s ${NeawolfIP} -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8081 -s ${NeawolfIP} -j ACCEPT
      ;;

    $IP_Database_1)
        echo -n "Server: $1 Database Rule"
          #Setting default filter policy
          $BinIpTables -P INPUT DROP
          $BinIpTables -P OUTPUT ACCEPT
          $BinIpTables -P FORWARD DROP

          #Allow unlimited traffic on loopback
          $BinIpTables -A INPUT -i lo -j ACCEPT
          $BinIpTables -A OUTPUT -o lo -j ACCEPT
          $BinIpTables -A FORWARD -o lo -j ACCEPT
          #Allow incoming ports ADMIN
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${NeawolfIP} -j ACCEPT

          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Firewall_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Firewall_2 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Webserver_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 80 -s $IP_Webserver_2 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Firewall_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Firewall_2 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Webserver_1 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 443 -s $IP_Webserver_2 -j ACCEPT

          #/sbin/iptables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8080 -s ${NeawolfIP} -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 8081 -s ${NeawolfIP} -j ACCEPT
          $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${NeawolfIP} -j ACCEPT
      ;;

  esac
}

#
#
#

preSet() {
    #Flushing all rules
    $BinIpTables -F
    $BinIpTables -F -t nat
    $BinIpTables -X
    $BinIpTables -X -t nat
}

postSetAll() {
  #$BinIpTables -A INPUT -p tcp --dport 80 -m limit --limit 60/minute --limit-burst 100 -j ACCEPT
  #$BinIpTables -A INPUT -p tcp --dport 443 -m limit --limit 60/minute --limit-burst 100 -j ACCEPT
  #$BinIpTables -A INPUT -p tcp --dport 53 -m limit --limit 10/minute --limit-burst 100 -j ACCEPT

  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${IP_Firewall_1} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${IP_Firewall_2} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${IP_Webserver_1} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${IP_Webserver_2} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 22 -s ${IP_Database_1} -j ACCEPT

  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${IP_Firewall_1} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${IP_Firewall_2} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${IP_Webserver_1} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${IP_Webserver_2} -j ACCEPT
  $BinIpTables -t filter -A INPUT -p tcp -d ${LocalIP} --dport 3306 -s ${IP_Database_1} -j ACCEPT

  $BinIpTables -A INPUT -p icmp --icmp-type echo-request -j ACCEPT
  $BinIpTables -A OUTPUT -p icmp --icmp-type echo-reply -j ACCEPT
  $BinIpTables -A INPUT -i eth0 -m state --state ESTABLISHED,RELATED -j ACCEPT
}

postSet() {
  case $1 in

    $IP_Firewall_1 | $IP_Firewall_2)
        #echo -n "// Server: $1 Firewall Rule"
          #Make sure nothing comes or goes out of this box
          $BinIpTables -A INPUT -j DROP
          $BinIpTables -A OUTPUT -j ACCEPT
          $BinIpTables -A FORWARD -j ACCEPT
          $BinIpTables -A FORWARD -o lo -j ACCEPT
      ;;

    $IP_Webserver_1 | $IP_Webserver_2)
        #echo -n "// Server: $1 Webserver Rule"
          #Make sure nothing comes or goes out of this box
          $BinIpTables -A INPUT -j DROP
          $BinIpTables -A OUTPUT -j ACCEPT
          $BinIpTables -A FORWARD -j DROP
          $BinIpTables -A FORWARD -o lo -j ACCEPT
      ;;

    $IP_Database_1)
        #echo -n "// Server: $1 Database Rule"
          #Make sure nothing comes or goes out of this box
          $BinIpTables -A INPUT -j DROP
          $BinIpTables -A OUTPUT -j ACCEPT
          $BinIpTables -A FORWARD -j DROP
          $BinIpTables -A FORWARD -o lo -j ACCEPT
      ;;

  esac
}

#
#
#


exportIpTablesRule "pre";

preSet "${LocalIP}"

readDirectory "${NEA_FW_ALLOW_PERMANENT}" "allow";
readDirectory "${NEA_FW_ALLOW_TEMPORARY}" "allow";
readDirectory "${NEA_FW_DROP_PERMANENT}" "allow";
readDirectory "${NEA_FW_DROP_TEMPORARY}" "allow";

setServerRule "${LocalIP}"

postSetAll
postSet "${LocalIP}"

exportIpTablesRule "post";

printf '%s\n' $COLOR_YELLOW;
#$(which iptables) -L
printf '%s\n' $COLOR_RESET;
