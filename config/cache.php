<?php

use Illuminate\Support\Str;

return [

    // use file cache for simplicity and reliability
    'default' => env('CACHE_STORE', 'file'),

    'stores' => [

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

    ],

    // prevent key collisions
    'prefix' => env(
        'CACHE_PREFIX',
        Str::slug((string) env('APP_NAME', 'ir-app')).'-cache-'
    ),

];