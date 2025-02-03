<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerifyIsAdmin;
use App\Http\Middleware\verifyIsCommercial;
use App\Http\Middleware\VerifyIsPropStore;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(VerifyIsAdmin::class); 
        $middleware->alias([
            'VerifyIsAdmin' =>  VerifyIsAdmin::class,
            'verifyIsCommercial' => verifyIsCommercial::class,
            'VerifyIsPropStore' => VerifyIsPropStore::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
