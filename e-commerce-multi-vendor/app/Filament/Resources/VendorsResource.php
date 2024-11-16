<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorsResource\Pages;
use App\Filament\Resources\VendorsResource\RelationManagers;
use App\Models\Vendors;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorsResource extends Resource
{
    protected static ?string $model = Vendors::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Vendor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\FileUpload::make('logo')->image()->required(),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\TextInput::make('user_id')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('company_name')->label('Company Name')->searchable(),
                TextColumn::make('address')->label('Address')->sortable()->searchable(),
                ImageColumn::make('logo')->label('Logo'),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('user_id')->label('User ID')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendors::route('/create'),
            'edit' => Pages\EditVendors::route('/{record}/edit'),
            'info' => Pages\VendorInfo::route('/info')
        ];
    }
}
