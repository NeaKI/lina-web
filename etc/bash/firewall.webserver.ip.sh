#!/bin/bash
declare -a IP_WEBSERVER;
IP_WEBSERVER[0]="185.239.208.38";
IP_WEBSERVER[1]="185.239.208.39";
BinIpTables=$(which iptables);
LocalIP="$(ip addr list eth0 |grep "inet " |cut -d' ' -f6|cut -d/ -f1)"

NMAP=$(which "nmap");

CURRENT_WEBSERVER_PING=999999.9;
CURRENT_WEBSERVER_IP=${IP_WEBSERVER[0]};
for i in "${IP_WEBSERVER[@]}"; do 
    CURRENT_WEBSERVER_TIME=$(${NMAP} -sS -Pn -n -p80 -d3 $i | grep "RCVD" | awk '{print $2}' | sed 's/[^0-9.]//g')
    echo ${CURRENT_WEBSERVER_TIME} " : $i";

        if [[ "$CURRENT_WEBSERVER_TIME" < "$CURRENT_WEBSERVER_PING" ]]; then
            CURRENT_WEBSERVER_PING=${CURRENT_WEBSERVER_TIME};
            CURRENT_WEBSERVER_IP=$i;
        fi
done


IP_WEBSERVER_FILE="/neawolf/log/iptables.webserver.ip.log";
if [[ $(< ${IP_WEBSERVER_FILE}) != "$CURRENT_WEBSERVER_IP" ]]; then
  echo ${CURRENT_WEBSERVER_IP} > ${IP_WEBSERVER_FILE};
  $BinIpTables -t nat -A PREROUTING -s 0/0 -p tcp -d ${LocalIP} --dport 80 -j DNAT --to ${CURRENT_WEBSERVER_IP}:80 -m comment --comment "WEBSERVER-FORWARD-RULE:80:${CURRENT_WEBSERVER_IP}" 
  $BinIpTables -t nat -A PREROUTING -s 0/0 -p tcp -d ${LocalIP} --dport 443 -j DNAT --to ${CURRENT_WEBSERVER_IP}:443 -m comment --comment "WEBSERVER-FORWARD-RULE:443:${CURRENT_WEBSERVER_IP}"

  if [[ "$CURRENT_WEBSERVER_IP" == ${IP_WEBSERVER[0]} ]]; then
      $(which iptables-save) | grep -v "WEBSERVER-FORWARD-RULE:80:${IP_WEBSERVER[1]}" | grep -v "WEBSERVER-FORWARD-RULE:443:${IP_WEBSERVER[1]}" | $(which iptables-restore)
      echo "X1:";
  else
      $(which iptables-save) | grep -v "WEBSERVER-FORWARD-RULE:80:${IP_WEBSERVER[0]}" | grep -v "WEBSERVER-FORWARD-RULE:443:${IP_WEBSERVER[0]}" | $(which iptables-restore)
      echo "X2:";
  fi
fi

echo $(date) ${CURRENT_WEBSERVER_IP};
echo "==========================";
echo "";
