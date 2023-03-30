<?php
use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['namespace' => '\Modules\User\src\Http\Controllers'], function() {
    Route::prefix('admin')->group(function() {
        Route::prefix('users')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/{id}', [UserController::class, 'detail'])->name('admin.users.detail');
        });
    });
});
