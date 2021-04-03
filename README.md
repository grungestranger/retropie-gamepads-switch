# retropie-gamepads-switch

## Installation guide

```
cd ~/
sudo apt install php7.3-cli composer
git clone https://github.com/grungestranger/retropie-gamepads-switch.git
cd retropie-gamepads-switch
composer du
cp config.example.php config.php
```

### Enter your data in the configuration file

```
nano config.php
```

### Add script launch to onstart script

```
nano /opt/retropie/configs/all/runcommand-onstart.sh
```

#### Insert the code

```
#!/bin/bash

sudo php /home/pi/retropie-gamepads-switch/onstart.php "$1"
```

### Add script launch to onend script

```
nano /opt/retropie/configs/all/runcommand-onend.sh
```

#### Insert the code

```
#!/bin/bash

sudo php /home/pi/retropie-gamepads-switch/onend.php "$1"
```
