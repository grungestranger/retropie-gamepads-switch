#!/bin/bash

cd ~/retropie-gamepads-switch
sudo apt install -y php-cli composer
composer du
cp config.example.php config.php

SHELL_STRING='#!/bin/bash'

RUNCOMMAND_ONSTART_FILE='/opt/retropie/configs/all/runcommand-onstart.sh'
RUNCOMMAND_ONSTART_SCRIPT='sudo php /home/pi/retropie-gamepads-switch/onstart.php "$1"'

RUNCOMMAND_ONEND_FILE='/opt/retropie/configs/all/runcommand-onend.sh'
RUNCOMMAND_ONEND_SCRIPT='sudo php /home/pi/retropie-gamepads-switch/onend.php'

if [ ! -f "$RUNCOMMAND_ONSTART_FILE" ]; then
    echo "$SHELL_STRING" > "$RUNCOMMAND_ONSTART_FILE"
fi

grep -q "$RUNCOMMAND_ONSTART_SCRIPT" "$RUNCOMMAND_ONSTART_FILE" || echo "\n$RUNCOMMAND_ONSTART_SCRIPT" >> "$RUNCOMMAND_ONSTART_FILE"

if [ ! -f "$RUNCOMMAND_ONEND_FILE" ]; then
    echo "$SHELL_STRING" > "$RUNCOMMAND_ONEND_FILE"
fi

grep -q "$RUNCOMMAND_ONEND_SCRIPT" "$RUNCOMMAND_ONEND_FILE" || echo "\n$RUNCOMMAND_ONEND_SCRIPT" >> "$RUNCOMMAND_ONEND_FILE"
