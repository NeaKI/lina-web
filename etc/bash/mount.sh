#!/bin/bash
mkdir -p /neawolf/mount > /dev/null

mkdir -p /neawolf/mount/firewall_1
mkdir -p /neawolf/mount/firewall_1/var
mkdir -p /neawolf/mount/firewall_1/neawolf

mkdir -p /neawolf/mount/firewall_2
mkdir -p /neawolf/mount/firewall_2/var
mkdir -p /neawolf/mount/firewall_2/neawolf

mkdir -p /neawolf/mount/database_server_1
mkdir -p /neawolf/mount/database_server_1/var
mkdir -p /neawolf/mount/database_server_1/neawolf

mkdir -p /neawolf/mount/webserver_1
mkdir -p /neawolf/mount/webserver_1/var
mkdir -p /neawolf/mount/webserver_1/neawolf

mkdir -p /neawolf/mount/webserver_2
mkdir -p /neawolf/mount/webserver_2/var
mkdir -p /neawolf/mount/webserver_2/neawolf

#sshfs root@45.67.221.30:/var/ /neawolf/mount/firewall_1/ -o ssh_command="sshpass -p ${PASSWD} ssh"

if (( $(mount | grep -e '/neawolf/mount/firewall_1/var'| wc -l) <= 0 ));
then     
  sshfs root@45.67.221.30:/var/ /neawolf/mount/firewall_1/var -o follow_symlinks -o dir_cache=no -o compression=no
fi
if (( $(mount | grep -e '/neawolf/mount/firewall_1/neawolf'| wc -l) <= 0 ));
then     
  sshfs root@45.67.221.30:/neawolf/ /neawolf/mount/firewall_1/neawolf -o follow_symlinks -o dir_cache=no -o compression=no
fi

if (( $(mount | grep -e '/neawolf/mount/firewall_2/var'| wc -l) <= 0 ));
then     
  sshfs root@45.88.223.172:/var/ /neawolf/mount/firewall_2/var -o follow_symlinks -o dir_cache=no -o compression=no
fi
if (( $(mount | grep -e '/neawolf/mount/firewall_2/neawolf'| wc -l) <= 0 ));
then     
  sshfs root@45.88.223.172:/neawolf/ /neawolf/mount/firewall_2/neawolf -o follow_symlinks -o dir_cache=no -o compression=no
fi

if (( $(mount | grep -e '/neawolf/mount/database_server_1/var'| wc -l) <= 0 ));
then     
  sshfs root@185.194.216.15:/var/ /neawolf/mount/database_server_1/var -o follow_symlinks -o dir_cache=no -o compression=no
fi
if (( $(mount | grep -e '/neawolf/mount/database_server_1/neawolf'| wc -l) <= 0 ));
then     
  sshfs root@185.194.216.15:/neawolf/ /neawolf/mount/database_server_1/neawolf -o follow_symlinks -o dir_cache=no -o compression=no
fi

if (( $(mount | grep -e '/neawolf/mount/webserver_1/var'| wc -l) <= 0 ));
then     
  sshfs root@185.239.208.38:/var/ /neawolf/mount/webserver_1/var -o follow_symlinks -o dir_cache=no -o compression=no
fi
if (( $(mount | grep -e '/neawolf/mount/webserver_1/neawolf'| wc -l) <= 0 ));
then     
  sshfs root@185.239.208.38:/neawolf/ /neawolf/mount/webserver_1/neawolf -o follow_symlinks -o dir_cache=no -o compression=no
fi

if (( $(mount | grep -e '/neawolf/mount/webserver_2/var'| wc -l) <= 0 ));
then     
  sshfs root@185.239.208.39:/var/ /neawolf/mount/webserver_2/var -o follow_symlinks -o dir_cache=no -o compression=no
fi
if (( $(mount | grep -e '/neawolf/mount/webserver_2/neawolf'| wc -l) <= 0 ));
then     
  sshfs root@185.239.208.39:/neawolf/ /neawolf/mount/webserver_2/neawolf -o follow_symlinks -o dir_cache=no -o compression=no
fi



chmod -R 0777 "/neawolf/web/";
chmod -R 0777 "/neawolf/web-dev/";
