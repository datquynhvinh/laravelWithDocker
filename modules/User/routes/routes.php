<?php
use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['namespace' => '\Modules\User\src\Http\Controllers'], function() {
    Route::prefix('module_users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('module_users.index');
        Route::get('/{id}', [UserController::class, 'detail'])->name('module_users.detail');
    });
});
