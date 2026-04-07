<?php

return [

    // default storage disk
    'default' => env('FILESYSTEM_DISK', 'local'),

    // filesystem disks
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

    ],

    // symbolic link for public access (kept for completeness)
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];