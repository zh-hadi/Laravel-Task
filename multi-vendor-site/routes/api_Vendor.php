<?php

use App\Http\Controllers\Api\V1\Vendor\ProductController;
use App\Http\Controllers\Api\V1\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

// vendor registation
Route::apiResource('vendor', VendorController::class)
    ->only(['store', 'show'])
    ->middleware(['auth:sanctum']);

// vendor products controller
Route::prefix('vendor')->group(function(){
     Route::apiResource('products', ProductController::class)
        ->except('index')
        ->middleware(['auth:sanctum']);
    Route::post('/products/index', [ProductController::class, 'index'])
        ->middleware(['auth:sanctum']);
});




