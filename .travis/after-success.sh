#!/usr/bin/env bash
#
# set -x;
set -e;
set -o pipefail;
#
# thisFile="$(readlink -f "${0}")";
# thisFilePath="$(dirname "${thisFile}")";
#
if [ "${PHP_COVERAGE}" = '1' ]; then
    bash <(curl -s https://codecov.io/bash);
fi
