<?php

use App\Internal\Web\Landing\Handler\LandingHandler;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingHandler::class, 'index'])->name('home');
