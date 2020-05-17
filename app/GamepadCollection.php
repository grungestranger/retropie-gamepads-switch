<?php

namespace App;

class GamepadCollection
{
    /** @var Gamepad[] */
    protected $gamepads;

    /**
     * @param Gamepad[] $gamepads
     */
    public function __construct(array $gamepads)
    {
        $this->gamepads = array_values($gamepads);
    }

    /**
     * @param array $params
     * @return Gamepad|null
     */
    public function pull(array $params): ?Gamepad
    {
        foreach ($this->gamepads as $key => $gamepad) {
            foreach ($params as $name => $value) {
                if ($gamepad->get($name) !== $value) {
                    continue 2;
                }
            }

            unset($this->gamepads[$key]);

            return $gamepad;
        }

        return null;
    }

    /**
     * @return Gamepad[]
     */
    public function toArray(): array
    {
        return $this->gamepads;
    }
}
