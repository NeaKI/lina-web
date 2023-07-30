#!/bin/bash

fusermount3 -u /neawolf/mount/firewall_1/var
fusermount3 -u /neawolf/mount/firewall_1/neawolf

fusermount3 -u /neawolf/mount/firewall_2/var
fusermount3 -u /neawolf/mount/firewall_2/neawolf

fusermount3 -u /neawolf/mount/webserver_1/var
fusermount3 -u /neawolf/mount/webserver_1/neawolf

fusermount3 -u /neawolf/mount/webserver_2/var
fusermount3 -u /neawolf/mount/webserver_2/neawolf

fusermount3 -u /neawolf/mount/database_server_1/var
fusermount3 -u /neawolf/mount/database_server_1/neawolf
