<?php

use App\Http\Middleware\CheckBookPermission;
use App\Http\Middleware\CheckGenrePermission;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckStatusPermission;
use App\Http\Middleware\LogUnauthorizedAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LogUnauthorizedAccess::class);
        // $middleware->append(CheckPermission::class);
        // $middleware->append(CheckBookPermission::class);
        // $middleware->append(CheckGenrePermission::class);
        // $middleware->append(CheckStatusPermission::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
