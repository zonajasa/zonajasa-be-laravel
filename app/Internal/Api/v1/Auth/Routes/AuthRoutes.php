<?php

use App\Internal\Api\v1\Auth\Handler\AuthHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthHandler::class, 'Login']);
    Route::post('/register', [AuthHandler::class, 'Register']);
    Route::post('/verify-otp', [AuthHandler::class, 'VerifyOTP']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthHandler::class, 'Logout'])->middleware('auth:api');
        Route::post('/profile', [AuthHandler::class, 'Profile'])->middleware('auth:api');
    });
});
