<?php

use App\Udevadm;

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

try {
    if (
        !isset($config['delay_between_controller_connections'])
        || !is_int($config['delay_between_controller_connections'])
    ) {
        throw new Exception('Config is not correct.');
    }

    if (!isset($argv[1])) {
        throw new Exception('Events not passed.');
    }

    $events = explode(',', $argv[1]);

    do {
        exec('pgrep retroarch', $output);

        if (!$output) {
            sleep(1);
        }
    } while (!$output);

    foreach ($events as $event) {
        sleep($config['delay_between_controller_connections']);

        Udevadm::triggerAdd((int) $event);
    }
} catch (Exception $e) {
    exit($e->getMessage() . PHP_EOL);
}
