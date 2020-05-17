<?php

namespace App;

class Gamepad
{
    /** @var int */
    protected $event;

    /** @var array */
    protected $data;

    /**
     * @param int $event
     * @param array $data
     */
    public function __construct(int $event, array $data)
    {
        $this->event = $event;
        $this->data  = $data;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @return int
     */
    public function getEvent(): int
    {
        return $this->event;
    }
}
