<?php

use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Social\SocialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisterController::class, 'getRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'postRegister'])->name('register');
Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::prefix('social')->group(function(){
    Route::get('/chinh-sach', [SocialController::class, 'index']);
    Route::get('/auth/{platform}', [SocialController::class, 'redirect'])->name('fb_login');
    Route::get('/callback/{platform}', [SocialController::class, 'callback']);
});
Route::prefix('product')->middleware('auth')->group(function(){
    Route::get('/list-products', [ProductsController::class, 'getProducts'])->name('list_products');
});