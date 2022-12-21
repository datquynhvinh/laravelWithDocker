<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->name('users.')->group(function(){
    Route::get('/list-users', [UserController::class, 'getUsers'])->name('list-users');
    Route::get('/{id}', [UserController::class, 'getUserDetail'])->name('detail');
    Route::post('/create', [UserController::class, 'createUser'])->name('create');
    Route::put('/{id}', [UserController::class, 'updateUser'])->name('update');
    Route::delete('/{id}', [UserController::class, 'deleteUser'])->name('delete');
});

Route::prefix('products')->name('products.')->group(function(){
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductsController::class, 'detail'])->name('show');
    Route::post('/create', [ProductsController::class, 'post'])->name('post');
    Route::put('/{id}', [ProductsController::class, 'update'])->name('update');
    Route::patch('/{id}', [ProductsController::class, 'patch'])->name('patch');
    Route::delete('/{id}', [ProductsController::class, 'delete'])->name('delete');
});
