<?php

use App\Http\Controllers\Api\V1\Admin\AdminController;
use App\Http\Controllers\Api\V1\Admin\AdminOrderController;
use App\Http\Controllers\Api\V1\Vendor\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('admin', [AdminController::class, 'index'])->middleware(['auth:sanctum','admin']);

Route::apiResource('order', AdminOrderController::class);//->middleware(['auth:sanctum']);




require __DIR__."/apiauth.php";
require __DIR__."/api_Vendor.php";
require __DIR__."/api_admin.php";