<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\SocialController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ChatBoxController;

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

Route::get('/register', [RegisterController::class, 'getRegister'])->name('get_register');
Route::post('/register', [RegisterController::class, 'postRegister'])->name('post_register');
Route::get('/login', [LoginController::class, 'getLogin'])->name('get_login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post_login');

Route::middleware('auth')->group(function() {
    // Route user
    Route::middleware('user')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::prefix('social')->group(function(){
            Route::get('/chinh-sach', [SocialController::class, 'index']);
            Route::get('/auth/{platform}', [SocialController::class, 'redirect'])->name('fb_login');
            Route::get('/callback/{platform}', [SocialController::class, 'callback']);
        });
        Route::prefix('products')->name('products.')->middleware('auth')->group(function(){
            Route::get('/list-products', [ProductsController::class, 'getProducts'])->name('list_products');
        });
        Route::prefix('orders')->group(function(){
            Route::get('/create', [OrderController::class, 'create']);
        });
        Route::prefix('users')->name('users.')->group(function() {
            Route::get('/user-info', [UserController::class, 'getUserLogin']);
            Route::get('/follow', [UserController::class, 'getFollowUsers'])->name('follow_users');
            Route::post('/{id}/follow', [UserController::class, 'follow'])->name('follow');
            Route::delete('/{id}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');
            Route::get('/refresh-notifications', [UserController::class, 'refreshNotifications'])->name('notifications');
            Route::get('/chatbox', [UserController::class, 'chatbox'])->name('chatbox');
        });
        Route::prefix('chatbox')->name('chat.')->group(function(){
            Route::get('/', [ChatBoxController::class, 'index'])->name('dashboard');
            Route::get('/messages', [ChatBoxController::class, 'getMessages']);
            Route::post('/messages', [ChatBoxController::class, 'postMessages']);
        });
    });

    // Route admin
    Route::prefix('/admin')->middleware('admin')->name('admin.')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('home');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

