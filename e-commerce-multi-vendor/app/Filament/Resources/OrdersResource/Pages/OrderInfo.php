<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use App\Models\Order;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class OrderInfo extends Page implements HasTable 
{
    use InteractsWithTable;
    protected static string $resource = OrdersResource::class;
    protected static string $view = 'filament.resources.orders-resource.pages.order-info';
    protected static string $model = Order::class;
    protected static ?string $navigationGroup = 'Order';
    protected static ?string $navigationLabel = 'Orders Info';

    public function table(Table $table): Table
    {
        $queryResult = Order::query()
                            ->join('order_invoice','orders.order_invoice_id','=','order_invoice.id')
                            ->select('orders.*','order_invoice.*');
        return $table
            ->query(
                $queryResult
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('address')->label('Address')->searchable(),
                TextColumn::make('phone')->label('Phone')->sortable()->searchable(),
                TextColumn::make('user_id')->label('User ID')->sortable()->searchable(),
                TextColumn::make('vendor_id')->label('Vendor ID')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->date(),
            ]);
    }
}
