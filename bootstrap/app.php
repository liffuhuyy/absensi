<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        $middleware->alias([
            'role' => App\Http\Middleware\RoleMiddleware::class
=======
        //
        $middleware->alias([
            "role" => RoleMiddleware::class
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
