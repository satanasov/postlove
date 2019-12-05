#!/bin/bash --

set -e
set -x

EXTNAME="${1}"
EXTDEPS="${2}"

# Check if package have dependencies in the
# 'require' object, inside the composer.json file
if [[ "${EXTDEPS}" == '1' ]]; then
	composer install \
		--working-dir=phpBB/ext/"${EXTNAME}" \
		--prefer-dist \
		--no-dev \
		--no-interaction
fi
