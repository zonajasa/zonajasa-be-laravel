<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
=======
#import landing routes
require base_path('app/Internal/Web/Landing/Routes/LandingRoutes.php');
>>>>>>> authentication
