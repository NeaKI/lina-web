#!/bin/bash
NEA_SCRIPT_HEADER_NAME="Firewall";
NEA_FW_DIRNAME=$(dirname "$0");
source "${NEA_FW_DIRNAME}/header.sh";
BinIpTables=$(which iptables);

    #Flushing all rules
    $BinIpTables -F
    $BinIpTables -X

    # generell settings
    ufw default allow INPUT
    ufw default allow OUTPUT
    ufw default allow FORWARD
    echo "1" > /proc/sys/net/ipv4/ip_forward
    echo 1 > /proc/sys/net/ipv4/conf/all/forwarding
    sysctl net.ipv4.ip_forward=1
    service ufw restart

source "${NEA_FW_DIRNAME}/firewall.reload.sh";
