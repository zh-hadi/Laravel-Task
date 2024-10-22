<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])
    ->name('home')
    ->middleware(['authCheck']);

Route::resource('products', ProductController::class)
    ->except('show')
    ->middleware(['authCheck']);

Route::prefix('/')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('registerPost');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});