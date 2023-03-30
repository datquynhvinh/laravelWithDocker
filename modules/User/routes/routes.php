<?php
use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['namespace' => '\Modules\User\src\Http\Controllers'], function() {
    Route::get('/users', 'UserController@index')->name('admin.users.index');
    Route::get('/users/{id}', 'UserController@detail')->name('admin.users.detail');
});
