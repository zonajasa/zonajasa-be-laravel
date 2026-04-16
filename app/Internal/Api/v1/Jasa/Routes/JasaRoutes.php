<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::prefix('jasa')->group(function () {
        // Define your Jasa routes here
    });
});
