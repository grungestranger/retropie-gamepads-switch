<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gamepads
    |--------------------------------------------------------------------------
    |
    | Enter here necessary information about your gamepads from file /proc/bus/input/devices.
    | If the element is a string, it will be considered the name of the controller.
    | If the device could not be found by parameters, it will be searched again only by name, if it is specified.
    |
    */

    'gamepads' => [
        1 => 'Sony Interactive Entertainment Controller',
        2 => '8BitDo M30 gamepad',
        3 => [
            'uniq' => '04:e8:a7:ab:63:25',
            'name' => 'Sony PLAYSTATION(R)3 Controller',
        ],
        4 => 'Sony PLAYSTATION(R)3 Controller',
        5 => 'PG-9062S',
    ],

    /*
    |--------------------------------------------------------------------------
    | Gamepads by systems
    |--------------------------------------------------------------------------
    |
    | For each system, enter the gamepad IDs listed above in the desired order.
    |
    */

    'gamepads_by_systems' => [
        'nes'          => [1, 2],
        'fds'          => [1, 2],
        'snes'         => [1, 2],
        'mastersystem' => [1, 2],
        'megadrive'    => [2, 1],
        'sega32x'      => [2, 1],
        'psx'          => [3, 4],
        'n64'          => [5, 3],
    ],

    /*
    |--------------------------------------------------------------------------
    | Delay between controller connections (in seconds)
    |--------------------------------------------------------------------------
    |
    | The delay is necessary for the gamepads to be connected in the correct order.
    |
    */

    'delay_between_controller_connections' => 2,

];
