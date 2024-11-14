<?php

namespace App\Providers;

use App\Filament\Resources\ProductResource\Pages\ProductInfoPage;
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
        Filament::registerPages([ ProductInfoPage::class, ]);
    }
}
