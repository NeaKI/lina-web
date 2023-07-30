#!/bin/sh
force_color_prompt=yes;
HOSTNAME=$(hostname);

COLOR_RESET="$(tput sgr0)"
COLOR_RESET="$(tput setaf 9)"
COLOR_BLACK="$(tput setaf 0)"
COLOR_RED="$(tput setaf 1)"
COLOR_GREEN="$(tput setaf 2)"
COLOR_YELLOW="$(tput setaf 3)"
COLOR_BLUE="$(tput setaf 4)"
COLOR_MAGENTA="$(tput setaf 5)"
COLOR_CYAN="$(tput setaf 6)"
COLOR_WHITE="$(tput setaf 7)"

printf '%s%s\n' $COLOR_GREEN $NEA_SCRIPT_HEADER_NAME;
printf '%*s\n' "${COLUMNS:-$(tput cols)}" '' | tr ' ' =
printf '%s\n' $COLOR_RESET;
