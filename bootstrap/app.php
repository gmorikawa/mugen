<?php

use App\Exceptions\BusinessException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (BusinessException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'type' => $e->getType()->value,
                    'code' => $e->getErrorCode(),
                    'message' => $e->getErrorMessage(),
                    'status' => $e->getHttpStatusCode(),
                ], $e->getHttpStatusCode());
            }
        });
    })->create();
