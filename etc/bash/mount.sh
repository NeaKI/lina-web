#!/bin/bash
mkdir /neawolf/mount

mkdir /neawolf/mount/firewall_1
mkdir /neawolf/mount/firewall_1/var
mkdir /neawolf/mount/firewall_1/neawolf

mkdir /neawolf/mount/firewall_2
mkdir /neawolf/mount/firewall_2/var
mkdir /neawolf/mount/firewall_2/neawolf

mkdir /neawolf/mount/database_server_1
mkdir /neawolf/mount/database_server_1/var
mkdir /neawolf/mount/database_server_1/neawolf

mkdir /neawolf/mount/webserver_1
mkdir /neawolf/mount/webserver_1/var
mkdir /neawolf/mount/webserver_1/neawolf

mkdir /neawolf/mount/webserver_2
mkdir /neawolf/mount/webserver_2/var
mkdir /neawolf/mount/webserver_2/neawolf

#sshfs root@45.67.221.30:/var/ /neawolf/mount/firewall_1/ -o ssh_command="sshpass -p ${PASSWD} ssh"

sshfs root@45.67.221.30:/var/ /neawolf/mount/firewall_1/var
sshfs root@45.67.221.30:/neawolf/ /neawolf/mount/firewall_1/neawolf

sshfs root@45.88.223.172:/var/ /neawolf/mount/firewall_2/var
sshfs root@45.88.223.172:/neawolf/ /neawolf/mount/firewall_2/neawolf

sshfs root@185.194.216.15:/var/ /neawolf/mount/database_server_1/var
sshfs root@185.194.216.15:/neawolf/ /neawolf/mount/database_server_1/neawolf

sshfs root@185.239.208.38:/var/ /neawolf/mount/webserver_1/var
sshfs root@185.239.208.38:/neawolf/ /neawolf/mount/webserver_1/neawolf

sshfs root@185.239.208.39:/var/ /neawolf/mount/webserver_2/var
sshfs root@185.239.208.39:/neawolf/ /neawolf/mount/webserver_2/neawolf

chmod -R 0777 "/neawolf/web/";