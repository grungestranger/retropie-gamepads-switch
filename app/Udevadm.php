<?php

namespace App;

class Udevadm
{
    /**
     * @param int $event
     */
    public static function triggerAdd(int $event)
    {
        exec("udevadm info /dev/input/event{$event}", $output, $return_var);

        if (!$return_var && strpos(implode('', $output), 'USEC_INITIALIZED') === false) {
            exec("udevadm trigger --action=add /dev/input/event{$event}");
        }
    }

    /**
     * @param int $event
     */
    public static function triggerRemove(int $event)
    {
        exec("udevadm trigger --action=remove /dev/input/event{$event}");
    }
}
