<?php

use App\Http\Controllers\Admin\api\AdminOrderApiController;
use App\Http\Controllers\Admin\api\AdminProductApiController;
use App\Http\Controllers\Admin\api\AdminVendorApiController;
use App\Http\Controllers\General\api\ShopApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('admin', [AdminController::class, 'index'])->middleware(['auth:sanctum','admin']);



Route::prefix('admin')->group(function(){
    Route::get('vendors', [AdminVendorApiController::class, 'vendor_list']);//->middleware(['auth:sanctum','admin']);
    Route::get('vendors/active', [AdminVendorApiController::class, 'active_vendor_list']);
    Route::get('products', [AdminProductApiController::class, 'products']);
    Route::get('orders', [AdminOrderApiController::class, 'index']);
});

Route::prefix('shop')->group(function(){
    Route::post('cart-save', [ShopApiController::class, 'cart_save']);
});


