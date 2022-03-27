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
        2 => 'Pro Controller',
        3 => '8BitDo M30 gamepad',
        4 => 'PG-9062S',
        5 => [
            'uniq' => '04:e8:a7:ab:63:25',
            'name' => 'Sony PLAYSTATION(R)3 Controller',
        ],
        6 => 'Sony PLAYSTATION(R)3 Controller',
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
        'atari2600'    => [4, 5],
        'atari7800'    => [1, 2],
        'nes'          => [2, 1],
        'fds'          => [2, 1],
        'snes'         => [1, 3],
        'mastersystem' => [1, 2],
        'megadrive'    => [3, 1],
        'sega32x'      => [3, 1],
        'segacd'       => [3, 1],
        'psx'          => [5, 6],
        'n64'          => [4, 5],
        'dreamcast'    => [4, 5],
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
