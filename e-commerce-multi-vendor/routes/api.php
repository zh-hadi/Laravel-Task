<?php

use App\Http\Controllers\Api\V1\Customer\CartController;
use App\Http\Controllers\Api\V1\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// customer route
Route::get('/products', [HomeController::class, 'index']);
Route::get('/products/{product}', [HomeController::class, 'show']);


Route::get('/category', [HomeController::class, 'categroy_index']);
Route::get('/category/{catagory}', [HomeController::class, 'category_show']);

// cart customer
Route::get('/user/cart', [CartController::class, 'index'])
    ->middleware(['auth:sanctum']);


    

require __DIR__.'/auth_api.php';