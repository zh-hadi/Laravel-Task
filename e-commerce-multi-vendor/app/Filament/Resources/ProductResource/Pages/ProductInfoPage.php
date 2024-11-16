<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductInfoPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string $resource = ProductResource::class;
    protected static string $model = Product::class;
    public $page_name = "Product Info";
    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationLabel = 'Product Info';
    protected static string $view = 'filament.resources.product-resource.pages.product-info-page';

    public function table(Table $table): Table
    {
        $queryResult =  Product::query()
                        ->leftJoin('orders','products.id','=','orders.product_id')
                        ->select('products.*',DB::raw('count(orders.id) as sale_count'))
                        ->groupBy('products.id');
        return $table
            ->query(
                $queryResult
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Product Name')->searchable(),
                TextColumn::make('price')->label('Price')->sortable()->searchable(),
                TextColumn::make('category_id')->label('Category')->sortable()->searchable(),
                TextColumn::make('sale_count')->label('Sale Count')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->date(),
            ]);
    }

    // protected function getTableQuery(): Builder
    // {
    //     return Product::query()
    //                 ->join('orders','products.id','=','orders.product_id')
    //                 ->select('products.*',DB::raw('count(orders.id) as sale_count'))
    //                 ->groupBy('products.id');
    // }

    // protected function getTableColumns(): array
    // {
    //     return [
            // TextColumn::make('name')->label('Product Name'),
            // TextColumn::make('price')->label('Price'),
            // TextColumn::make('category_id')->label('Category'),
            // TextColumn::make('created_at')->label('Created At')->date(),
    //     ];
    // }

    // public function getViewData(): array
    // {
    //     $queryResult =  Product::query()
    //                     ->leftJoin('orders','products.id','=','orders.product_id')
    //                     ->select('products.*',DB::raw('count(orders.id) as sale_count'))
    //                     ->groupBy('products.id')->get();
    //     $strArr = [TextColumn::make('name')->label('Product Name'),
    //     TextColumn::make('price')->label('Price'),
    //     TextColumn::make('category_id')->label('Category'),
    //     TextColumn::make('created_at')->label('Created At')->date(),];
    //     $data = [
    //         'columns' => $strArr,
    //         'query' => $queryResult,
    //     ];

    //     // $data = [
    //     //     'columns' => $this->getTableColumns(),
    //     //     'query' => $this->getTableQuery(),
    //     // ];
    //     //dd($data);
    //     return $data;
    // }

    
   
    
}

