<?php

namespace App\Filament\Resources\VendorsResource\Pages;

use App\Filament\Resources\VendorsResource;
use App\Models\Vendors;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class VendorInfo extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string $resource = VendorsResource::class;

    protected static string $view = 'filament.resources.vendors-resource.pages.vendor-info';
    protected static string $model = Vendors::class;
    protected static ?string $navigationGroup = 'Vendor';
    protected static ?string $navigationLabel = 'Vendors Info';

    public function table(Table $table): Table
    {
        $queryResult = Vendors::query()
                            ->join('products','products.user_id','=','vendors.id')
                            ->select('vendors.*',DB::raw('count(products.user_id) as total_product'))
                            ->groupBy('products.user_id');
        return $table
            ->query(
                $queryResult
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('company_name')->label('Company Name')->searchable(),
                TextColumn::make('address')->label('Address')->sortable()->searchable(),
                ImageColumn::make('logo')->label('Logo'),
                TextColumn::make('total_product')->label('Total Product')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('user_id')->label('User ID')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->date(),
            ]);
    }
}
