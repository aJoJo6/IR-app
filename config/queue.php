<?php

return [

    // default queue connection
    'default' => env('QUEUE_CONNECTION', 'sync'),

    // queue connections
    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

    ],

    // job batching
    'batching' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'job_batches',
    ],

    // failed jobs
    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'null'),
    ],

];