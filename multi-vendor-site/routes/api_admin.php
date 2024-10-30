<?php

use App\Http\Controllers\Api\V1\Admin\AdminVendorController;
use App\Http\Controllers\Api\V1\Vendor\ProductController;
use App\Http\Controllers\Api\V1\Vendor\VendorController;
use Illuminate\Support\Facades\Route;


// Admin Controller
Route::prefix('admin')->group(function(){
    Route::get('vendors', [AdminVendorController::class, 'vendor_list']);//->middleware(['auth:sanctum','admin']);
    Route::get('vendors/active', [AdminVendorController::class, 'active_vendor_list']);
});




