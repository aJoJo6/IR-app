<?php

return [

    // application identity
    'name' => env('APP_NAME', 'Industrial Revolutions Explorer'),

    // environment configuration
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', true), // enabled in development only

    // base url
    'url' => env('APP_URL', 'http://localhost'),

    // localisation
    'timezone' => 'Europe/London',
    'locale' => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    // security
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    // maintenance mode
    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];