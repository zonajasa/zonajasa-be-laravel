<?php

use App\Internal\Web\MasterData\User\Handler\UserMasterHandler;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserMasterHandler::class, 'index'])->name('home');
