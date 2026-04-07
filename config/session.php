<?php

use Illuminate\Support\Str;

return [

    // use file sessions for simplicity
    'driver' => env('SESSION_DRIVER', 'file'),

    // session lifetime in minutes
    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    // session encryption
    'encrypt' => env('SESSION_ENCRYPT', false),

    // session file storage
    'files' => storage_path('framework/sessions'),

    // session cookie name
    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'ir-app')).'-session'
    ),

    // cookie path
    'path' => env('SESSION_PATH', '/'),

    // cookie domain
    'domain' => env('SESSION_DOMAIN'),

    // https only
    'secure' => env('SESSION_SECURE_COOKIE'),

    // block js access
    'http_only' => env('SESSION_HTTP_ONLY', true),

    // csrf-friendly default
    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    // partitioned cookies
    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];