<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh-token', [AuthController::class, 'refreshToken']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('users')->name('users.')->group(function(){
        Route::post('/create', [UserController::class, 'createUser']);
        Route::get('/list-users', [UserController::class, 'getUsers']);
        Route::get('/{id}', [UserController::class, 'getUserDetail']);
        Route::put('/{id}', [UserController::class, 'updateUser']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
    });

    Route::prefix('products')->name('products.')->group(function(){
        Route::get('/', [ProductsController::class, 'index']);
        Route::get('/{id}', [ProductsController::class, 'detail']);
        Route::post('/create', [ProductsController::class, 'post']);
        Route::put('/{id}', [ProductsController::class, 'update']);
        Route::patch('/{id}', [ProductsController::class, 'patch']);
        Route::delete('/{id}', [ProductsController::class, 'delete']);
    });

    Route::get('logout', [AuthController::class, 'logout']);
});
