#!/bin/bash
NEA_SRV_DIRNAME=$(dirname "$0");

$(which php) -S 0.0.0.0:90 -t "${NEA_SRV_DIRNAME}/" &
