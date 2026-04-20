<?php

use App\Internal\Api\v1\Profile\Handler\ProfileHandler;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileHandler::class, 'index']);
        Route::put('/{id}', [ProfileHandler::class, 'update']);
    });
});
