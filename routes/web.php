<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'signin'])->name('login');
Route::post('/store-signin', [AuthController::class, 'storeSignin'])->name('store.signin');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/store-signup', [AuthController::class, 'storeSignup'])->name('store.signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::prefix('products')->group(function () {
        Route::get('/list',[ProductController::class, 'list']);
    });
});