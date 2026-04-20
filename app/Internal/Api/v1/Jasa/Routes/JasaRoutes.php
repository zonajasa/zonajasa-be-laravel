<?php

use App\Internal\Api\v1\Jasa\Handler\JasaHandler;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::prefix('jasa')->group(function () {
        Route::get('/list', [JasaHandler::class, 'list']);
        Route::get('/', [JasaHandler::class, 'index']);
        Route::post('/', [JasaHandler::class, 'create']);
        Route::put('/{id}', [JasaHandler::class, 'update']);
        Route::delete('/{id}', [JasaHandler::class, 'delete']);
    });
});
