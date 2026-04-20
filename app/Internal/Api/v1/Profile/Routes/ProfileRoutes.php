<?php

use App\Internal\Api\v1\Profile\Handler\ProfileHandler;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::prefix('profile')->group(function () {
        // Route::get('/list', [ProfileHandler::class, 'list']);
        // Route::get('/', [ProfileHandler::class, 'index']);
        // Route::post('/', [ProfileHandler::class, 'create']);
        Route::put('/{id}', [ProfileHandler::class, 'update']);
        // Route::delete('/{id}', [ProfileHandler::class, 'delete']);
    });
});
