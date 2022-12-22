<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh-token', [AuthController::class, 'refreshToken']);

Route::post('/users/create', [UserController::class, 'createUser']);
Route::middleware('auth:api')->prefix('users')->group(function(){
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
