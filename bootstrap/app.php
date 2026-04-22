<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->use([
            \Illuminate\Http\Middleware\HandleCors::class,

        ]);
        $middleware->alias([
            'auth' => App\Infrastructure\Http\v1\Middleware\AuthenticatedMiddleware::class,
            'user.header' => \App\Infrastructure\Http\v1\Middleware\UserHeaderMiddleware::class,
            'admin.header' => \App\Infrastructure\Http\v1\Middleware\AdminHeaderMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
