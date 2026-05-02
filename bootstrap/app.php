<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;    
use Symfony\Component\HttpKernel\Exception\HttpException;  
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Validation\ValidationException; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, \Throwable $e) {
            if ($request->is('api/*') || $request->is('*v1/*')) {
                return true;
            }
            return $request->expectsJson();
        });

        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->is('*v1/*') || $request->wantsJson()) {
                $status = 500;
                $errors = null;
                $message = $e->getMessage();

                if ($e instanceof ValidationException) {
                    $status = $e->status;
                    $errors = $e->errors();
                    $message = 'Erro de validação';
                } elseif ($e instanceof HttpException) {
                    $status = $e->getStatusCode();
                } elseif ($e instanceof ModelNotFoundException) {
                    $status = 404;
                    $message = 'Registro não encontrado';
                }

                return response()->json([
                    'status' => $status < 400 ? 'success' : 'error',
                    'message' => $message ?: 'Erro interno do servidor',
                    'data' => null,
                    'errors' => $errors,
                ], $status);
            }
        });
    })->create();
