<?php

use App\Internal\Web\MasterData\User\Handler\UserMasterHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', [UserMasterHandler::class, 'list'])->name('master-data.list');
    Route::post('/', [UserMasterHandler::class, 'store'])->name('master-data.store');
    Route::put('/{id}', [UserMasterHandler::class, 'update'])->name('master-data.update');
    Route::delete('/{id}', [UserMasterHandler::class, 'delete'])->name('master-data.delete');
});
