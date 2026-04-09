<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// configure laravel application
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // web routes
        commands: __DIR__.'/../routes/console.php', // artisan commands
        health: '/up', // health check endpoint
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // route middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // custom exception handling
    })
    ->create(); // create app instance