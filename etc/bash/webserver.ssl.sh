#!/bin/bash
WEBSERVER_SSL_PATH_ORG_1="/neawolf/mount/webserver_1/var/www/clients/client1/web2/ssl";
WEBSERVER_SSL_PATH_WWW_1="/neawolf/mount/webserver_1/var/www/clients/client1/web2/ssl/web";

WEBSERVER_SSL_PATH_ORG_2="/neawolf/mount/webserver_2/var/www/clients/client1/web1/ssl";
WEBSERVER_SSL_PATH_WWW_2="/neawolf/mount/webserver_2/var/www/clients/client1/web1/ssl/web";

SSL_NAME="lina-narzisse.de-le";


####


isWwwSslFile() {
  # webserver 1
  if [[ -f "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.crt" && -f "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.key" ]]; then
    echo "";
  else 
      cp -arp "${WEBSERVER_SSL_PATH_ORG_1}/${SSL_NAME}.crt" "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.crt"
      cp -arp "${WEBSERVER_SSL_PATH_ORG_1}/${SSL_NAME}.key" "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.key"
  fi

  # webserver 2
  if [[ -f "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.crt" && -f "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.key" ]]; then
    echo "";
  else 
      cp -arp "${WEBSERVER_SSL_PATH_ORG_2}/${SSL_NAME}.crt" "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.crt"
      cp -arp "${WEBSERVER_SSL_PATH_ORG_2}/${SSL_NAME}.key" "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.key"
  fi
}


checkFileIsNewer() {
  if [[ "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.crt" -nt "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.crt" ]]; then
      cp -arp "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.crt" "${WEBSERVER_SSL_PATH_WWW_2}/";
      cp -arp "${WEBSERVER_SSL_PATH_WWW_1}/${SSL_NAME}.key" "${WEBSERVER_SSL_PATH_WWW_2}/";
  else 
      cp -arp "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.crt" "${WEBSERVER_SSL_PATH_WWW_1}/";
      cp -arp "${WEBSERVER_SSL_PATH_WWW_2}/${SSL_NAME}.key" "${WEBSERVER_SSL_PATH_WWW_1}/";
  fi
}



###


isWwwSslFile;
checkFileIsNewer;
