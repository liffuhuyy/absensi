<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\AddQueuedCookiesToResponse;
use App\Http\Middleware\StartSession;
use App\Http\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\SubstituteBindings;
use App\Http\Middleware\SetCacheHeaders;

class Kernel extends HttpKernel
{
    /**
     * Global middleware yang akan berjalan pada setiap request.
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware grup yang digunakan pada aplikasi.
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware rute yang bisa digunakan secara individu.
     */
    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}