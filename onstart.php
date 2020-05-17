<?php

use App\DevicesParser;
use App\GamepadCollection;
use App\Udevadm;

require __DIR__ . '/vendor/autoload.php';

const WRONG_CONFIG_MESSAGE = 'Config is not correct.';

$config = require __DIR__ . '/config.php';

try {
    if (
        !isset($config['gamepads'])
        || !is_array($config['gamepads'])
        || !isset($config['gamepads_by_systems'])
        || !is_array($config['gamepads_by_systems'])
        || !isset($config['delay_between_controller_connections'])
        || !is_int($config['delay_between_controller_connections'])
    ) {
        throw new Exception(WRONG_CONFIG_MESSAGE);
    }

    foreach ($config['gamepads'] as $gamepadData) {
        if (!$gamepadData || !is_string($gamepadData) && !is_array($gamepadData)) {
            throw new Exception(WRONG_CONFIG_MESSAGE);
        }

        if (is_array($gamepadData)) {
            foreach ($gamepadData as $param) {
                if (!$param || !is_string($param)) {
                    throw new Exception(WRONG_CONFIG_MESSAGE);
                }
            }
        }
    }

    foreach ($config['gamepads_by_systems'] as $gamepadIndexes) {
        if (
            !$gamepadIndexes
            || !is_array($gamepadIndexes)
            || count($gamepadIndexes) != count(array_unique($gamepadIndexes))
        ) {
            throw new Exception(WRONG_CONFIG_MESSAGE);
        }

        foreach ($gamepadIndexes as $index) {
            if (
                !is_int($index) && !is_string($index)
                || !isset($config['gamepads'][$index])
            ) {
                throw new Exception(WRONG_CONFIG_MESSAGE);
            }
        }
    }

    if (!isset($argv[1])) {
        throw new Exception('System\'s name not passed.');
    }

    $system = $argv[1];

    if (isset($config['gamepads_by_systems'][$system])) {
        $parser   = new DevicesParser();
        $gamepads = new GamepadCollection($parser->parse()->getGamepads());

        $gamepadIndexes = array_values($config['gamepads_by_systems'][$system]);
        $systemGamepads = [];

        foreach ($gamepadIndexes as $key => $index) {
            $gamepadData = $config['gamepads'][$index];

            if (is_array($gamepadData)) {
                $gamepad = $gamepads->pull($gamepadData);

                if ($gamepad) {
                    $systemGamepads[$key] = $gamepad;
                }
            }
        }

        if (count($systemGamepads) < count($gamepadIndexes)) {
            foreach ($gamepadIndexes as $key => $index) {
                if (!isset($systemGamepads[$key])) {
                    $name        = null;
                    $gamepadData = $config['gamepads'][$index];

                    if (is_string($gamepadData)) {
                        $name = $gamepadData;
                    } elseif (isset($gamepadData['name'])) {
                        $name = $gamepadData['name'];
                    }

                    if ($name) {
                        $gamepad = $gamepads->pull(['name' => $name]);

                        if ($gamepad) {
                            $systemGamepads[$key] = $gamepad;
                        }
                    }
                }
            }
        }

        if ($systemGamepads) {
            ksort($systemGamepads);

            array_shift($systemGamepads);

            foreach (array_merge($gamepads->toArray(), $systemGamepads) as $gamepad) {
                Udevadm::triggerRemove($gamepad->getEvent());
            }

            if ($systemGamepads) {
                $events = array_map(function ($gamepad) {
                    return $gamepad->getEvent();
                }, $systemGamepads);

                exec('php ' . __DIR__ . '/background.php ' . implode(',', $events) . ' > /dev/null 2>&1 &');
            }
        }
    }
} catch (Exception $e) {
    exit($e->getMessage() . PHP_EOL);
}
