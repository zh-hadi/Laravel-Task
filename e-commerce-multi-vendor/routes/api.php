<?php

use App\Http\Controllers\Admin\api\AdminVendorApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('admin', [AdminController::class, 'index'])->middleware(['auth:sanctum','admin']);

Route::apiResource('order', AdminVendorApiController::class);

Route::prefix('admin')->group(function(){
    Route::get('vendors', [AdminVendorApiController::class, 'vendor_list']);//->middleware(['auth:sanctum','admin']);
    Route::get('vendors/active', [AdminVendorApiController::class, 'active_vendor_list']);
});
