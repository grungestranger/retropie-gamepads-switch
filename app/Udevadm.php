<?php

namespace App;

class Udevadm
{
    const COMMAND = 'udevadm';

    const OPERATION_INFO    = 'info';
    const OPERATION_TRIGGER = 'trigger';

    const ACTION_ADD    = '--action=add';
    const ACTION_REMOVE = '--action=remove';

    const INPUT_EVENT_PATH = '/dev/input/event';

    /**
     * @param int $event
     */
    public static function triggerAdd(int $event)
    {
        exec(
            static::COMMAND . ' ' . static::OPERATION_INFO . ' ' . static::INPUT_EVENT_PATH . $event,
            $output,
            $return_var
        );

        if (!$return_var && strpos(implode('', $output), 'USEC_INITIALIZED') === false) {
            exec(
                static::COMMAND . ' ' . static::OPERATION_TRIGGER . ' ' . static::ACTION_ADD
                    . ' ' . static::INPUT_EVENT_PATH . $event
            );
        }
    }

    /**
     * @param int $event
     */
    public static function triggerRemove(int $event)
    {
        exec(
            static::COMMAND . ' ' . static::OPERATION_TRIGGER . ' ' . static::ACTION_REMOVE
                . ' ' . static::INPUT_EVENT_PATH . $event
        );
    }
}
