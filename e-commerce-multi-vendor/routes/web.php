<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductAttributesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\General\ShopController;
use App\Http\Controllers\Vendor\VendorMainController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorStoreController;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('dashboard');


//  admin route
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function(){

    Route::prefix('admin')->group(function(){

        Route::controller(AdminMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.setting');
            // Route::get('/manage/user', 'manage_user')->name('admin.manage.user');
            Route::get('/manage/store', 'manage_stores')->name('admin.manage.store');
            Route::get('/manage/vendor', 'manage_vendor')->name('admin.manage.vendor');
            Route::get('/history/cart', 'cart_history')->name('admin.history.cart');
            Route::get('/history/order', 'order_history')->name('admin.history.order');
        });

        Route::controller(AdminUserController::class)->group(function(){
            Route::get('/manage/user', 'manage_user')->name('admin.manage.user');
        });

        //Filament::routes();

        Route::controller(CategoryController::class)->group(function(){
            Route::get('/category/create', 'create')->name('admin.category.create');
            Route::get('/category/manage', 'manage')->name('admin.category.manage');
        });

        Route::controller(SubCategoryController::class)->group(function(){
            Route::get('/subcategory/create', 'create')->name('admin.subcategory.create');
            Route::get('/subcategory/manage', 'manage')->name('admin.subcategory.manage');
        });

        Route::controller(ProductController::class)->group(function(){
            Route::get('/product/manage', 'manage')->name('admin.product.mange');
            Route::get('/product/review', 'productReview')->name('admin.product.review');
        });

        Route::controller(ProductAttributesController::class)->group(function(){
            Route::get('/productattributes/create', 'create')->name('admin.productattr.create');
            Route::get('/productattributes/manage', 'manage')->name('admin.productattr.manage');
     
        });

        Route::controller(DiscountController::class)->group(function(){
            Route::get('/discount/create', 'create')->name('admin.discount.create');
            Route::get('/discount/manage', 'manage')->name('admin.discount.manage');
        });

    });
});

// vendor route
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function(){
    Route::prefix('vendor')->group(function(){
        Route::controller(VendorMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('vendor');
        });

        Route::controller(VendorProductController::class)->group(function(){
            Route::get('/product/create', 'create')->name('vendor.product.create');
            Route::get('/product/manage', 'manage')->name('vendor.product.manage');
        });

        Route::controller(VendorStoreController::class)->group(function(){
            Route::get('/store/manage', 'manage')->name('vendor.store.manage');
        });

        Route::controller(VendorOrderController::class)->group(function(){
            Route::get('/order/history', 'index')->name('vendor.order.history');
        });
    });
});





Route::middleware('auth')->group(function () {
    
    Route::get('/shop', [ShopController::class,'shop_view'])->name('shop');
    Route::post('/shop', [ShopController::class,'shop_q'])->name('shop');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
