<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: [
            __DIR__.'/../routes/api/v1/auth.php',
            __DIR__.'/../routes/api/v1/employees.php',
        ],
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',


    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api('throttle:api');
        $middleware->statefulApi();
        $middleware->validateCsrfTokens(except: [

        ]);
        $middleware->alias([
            'checkAuth' => \App\Http\Middleware\CheckAuth::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        
        ]);
        // $middleware->api(prepend: [
        //     \Illuminate\Cookie\Middleware\EncryptCookies::class,
        //     \Illuminate\Session\Middleware\StartSession::class,
        // ]);
    })
    ->withExceptions(function(Exceptions $exceptions) {
        //
    })->create();
