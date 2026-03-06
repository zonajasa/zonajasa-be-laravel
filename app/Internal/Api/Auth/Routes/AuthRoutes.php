<?php

use App\Internal\Api\Auth\Handler\AuthHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthHandler::class, 'Login']);
    Route::post('/verify-otp', [AuthHandler::class, 'VerifyOTP']);
});
