<?php

use App\DevicesParser;
use App\Udevadm;

require __DIR__ . '/vendor/autoload.php';

try {
    $parser   = new DevicesParser();
    $gamepads = $parser->parse()->getGamepads();

    foreach ($gamepads as $gamepad) {
        Udevadm::triggerAdd($gamepad->getEvent());
    }
} catch (Exception $e) {
    exit($e->getMessage() . PHP_EOL);
}
