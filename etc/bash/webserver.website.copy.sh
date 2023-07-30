#!/bin/bash
WEBSITE_ORG="/neawolf/web";
WEBSITE_WWW_1="/neawolf/mount/webserver_1/neawolf/";
WEBSITE_WWW_2="/neawolf/mount/webserver_2/neawolf/";



####


copyFiles() {
  mkdir "${WEBSITE_WWW_1}/";
  cp -arp "${WEBSITE_ORG}/" "${WEBSITE_WWW_1}/";

  mkdir "${WEBSITE_WWW_2}/";
  cp -arp "${WEBSITE_ORG}/" "${WEBSITE_WWW_2}/";
}



###

copyFiles;
