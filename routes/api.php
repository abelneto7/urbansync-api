<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HealthCheckController;
use App\Http\Controllers\Api\V1\InterdicaoController;
use App\Http\Controllers\Api\V1\UserController;

Route::prefix('v1')->group(function () {
    Route::get('/health-check', HealthCheckController::class)->name('health-check');

    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/usuario', [UserController::class, 'store'])->name('usuario.store');

    Route::middleware('auth:api')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/auth/me', [AuthController::class, 'me'])->name('auth.me');
        Route::post('/auth/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');

        Route::apiResource('interdicao', InterdicaoController::class);

        Route::apiResource('usuario', UserController::class)->except(['store']);
    });
});
