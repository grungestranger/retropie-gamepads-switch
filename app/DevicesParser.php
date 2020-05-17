<?php

namespace App;

class DevicesParser
{
    const DEVICES_PATH = '/proc/bus/input/devices';

    /** @var Gamepad[] */
    protected $gamepads = [];

    /**
     * @return array
     */
    public function getGamepads(): array
    {
        return $this->gamepads;
    }

    /**
     * @return $this
     */
    public function parse(): self
    {
        $devices = explode(PHP_EOL . PHP_EOL, file_get_contents(static::DEVICES_PATH));

        foreach ($devices as $device) {
            if (preg_match('/^H: Handlers=js\d+ event(\d+)/m', $device, $matches)) {
                $event  = (int) $matches[1];
                $data   = [];
                $params = explode(PHP_EOL, $device);

                foreach ($params as $param) {
                    if (preg_match('/^\S+ ([^=]+)="?(.+?)"?$/', $param, $matches)) {
                        $data[strtolower($matches[1])] = $matches[2];
                    }
                }

                $gamepad = new Gamepad($event, $data);

                $this->gamepads[] = $gamepad;
            }
        }

        return $this;
    }
}
