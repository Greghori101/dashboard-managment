<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('/signup',  'signup');
        Route::post('/login',  'login');
        Route::post('/forgot-password',  'forgotPassword');
        Route::post('/reset-password',  'resetPassword');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout',  'logout');
            Route::post('/logout-all',  'logoutAll');
            Route::post('/change-password',  'changePassword');
            Route::get('/me',  'me');
            Route::put('/me',  'updateProfile');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('dashboards')->controller(DashboardController::class)->group(function () {
            Route::get('',  'index');
            Route::get('/{id}',  'show');
            Route::get('/{id}/versions',  'versions');
            Route::post('',  'store');
            Route::put('/{id}',  'update');
            Route::post('/{id}/rollback/{versionId}',  'rollback');
        });
    });
});
