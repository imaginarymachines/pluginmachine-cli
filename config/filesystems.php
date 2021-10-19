<?php
//https://laravel-zero.com/docs/filesystem#with-the-storage-facade
return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => getcwd(),
        ],
    ],
];
