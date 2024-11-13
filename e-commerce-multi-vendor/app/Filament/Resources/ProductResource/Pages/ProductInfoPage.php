<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\Page;

class ProductInfoPage extends Page
{

    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.resources.product-resource.pages.product-info-page';
}
