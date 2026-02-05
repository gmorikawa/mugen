<?php

use App\Shared\Exceptions\BusinessException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$errors_metadata = include __DIR__ . '/../config/exception.php';

function get_exception_http_status(Exception $e): int
{
    global $errors_metadata;

    $exception_class = get_class($e);
    if (array_key_exists($exception_class, $errors_metadata)) {
        return $errors_metadata[$exception_class]['http_status'];
    }

    return 500;
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions
            ->render(function (AuthenticationException $e, Request $request) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'message' => 'You are not authenticated.',
                    ], 401);
                }
            })
            ->render(function (BusinessException $e, Request $request) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'message' => $e->getMessage(),
                    ], get_exception_http_status($e));
                }
            });
    })->create();
