<?php

namespace App\Providers;

use App\Filament\Resources\OrdersResource\Pages\OrderInfo;
use App\Filament\Resources\ProductResource\Pages\ProductInfoPage;
use App\Filament\Resources\VendorsResource\Pages\VendorInfo;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::registerPages([ ProductInfoPage::class, OrderInfo::class, VendorInfo::class]);
    }
}
