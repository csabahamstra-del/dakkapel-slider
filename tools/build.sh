#!/bin/bash
# Bouwt veryo.zip met de themamap veryo/ als enige map in de root.
set -euo pipefail
cd "$(dirname "$0")/.."
rm -f veryo.zip
zip -rq veryo.zip veryo -x "*.DS_Store" "*/.git/*" "*/node_modules/*" "*~"
unzip -l veryo.zip | tail -1
