<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Forms\Components\Builder;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;

class ProductInfoPage extends Page
{
    use Tables\Concerns\InteractsWithTable;
    protected static string $resource = ProductResource::class;
    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationLabel = 'Product Info';

    protected function getTableQuery(): Builder
    {
        return Product::query()
                    ->join('orders','products.id','=','orders.product_id')
                    ->select('products.*',DB::raw('count(orders.id) as sale_count'))
                    ->groupBy('products.id')
                    ->get();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Product Name'),
            TextColumn::make('price')->label('Price'),
            TextColumn::make('category_id')->label('Category'),
            TextColumn::make('created_at')->label('Created At')->date(),
        ];
    }

    public function render(): View
    {
        return view('filament.resources.product-resource.pages.product-info-page', [
            'columns' => $this->getTableColumns(),
            'query' => $this->getTableQuery(),
        ]);
    }

    

    protected static string $view = 'filament.resources.product-resource.pages.product-info-page';
}

