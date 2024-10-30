<?php

use App\Http\Controllers\Api\V1\Admin\AdminController;
use App\Http\Controllers\Api\V1\Vendor\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('admin', [AdminController::class, 'index'])->middleware(['auth:sanctum','admin']);




require __DIR__."/apiauth.php";
require __DIR__."/api_Vendor.php";
require __DIR__."/api_admin.php";