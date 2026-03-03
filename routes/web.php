<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/landing', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
