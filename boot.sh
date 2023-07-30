#!/bin/bash
HOSTNAME=$(hostname);
NEA_SCRIPT_HEADER_NAME="NEAWOLF TERMINAL: ${HOSTNAME}";
NEA_DIRNAME=$(dirname "$0");
echo -en "\x0c"; #clear console

source "${NEA_DIRNAME}/etc/bash/header.sh"

# firewall
exec "${NEA_DIRNAME}/etc/bash/firewall.sh"


printf '%s%s\n' $COLOR_GREEN 'NEAWOLF END';
printf '%*s\n' "${COLUMNS:-$(tput cols)}" '' | tr ' ' =
printf '%s\n' $COLOR_RESET;


