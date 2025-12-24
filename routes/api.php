<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HealthController;



Route::prefix('v1')->group(function () {

    Route::get('/health', [HealthController::class, 'index']);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);

        Route::get('jobs', [JobController::class, 'index']);
        Route::post('jobs', [JobController::class, 'store']);
        Route::get('jobs/{job}', [JobController::class, 'show']);
        Route::put('jobs/{job}', [JobController::class, 'update']);
        Route::delete('jobs/{job}', [JobController::class, 'destroy']);
    });
});
