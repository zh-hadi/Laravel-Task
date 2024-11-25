<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Products';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\TextInput::make('category_id')->required(),
                Forms\Components\FileUpload::make('image') ->image() ->required(),
                Forms\Components\TextInput::make('price')->required(),
                Forms\Components\TextInput::make('brand')->required(),
                Forms\Components\TextInput::make('discount_price')->required(),
                Forms\Components\TextInput::make('quantity')->required(),
                Forms\Components\TextInput::make('user_id')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('description')->extraAttributes([
                    'style'=>'max-width:200px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'
                ])->searchable(),
                TextColumn::make('category_id')->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('price')->searchable(),
                TextColumn::make('brand')->searchable(),
                TextColumn::make('discount_price')->searchable(),
                TextColumn::make('quantity')->searchable(),
                TextColumn::make('user_id')->searchable(),
                TextColumn::make('created_at')->searchable(),
                TextColumn::make('updated_at')->searchable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'info' => Pages\ProductInfoPage::route('/info')
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->record->clearMediaCollection('images');
        $this->record->addMedia($data['image'])->toMediaCollection('images');
        return $data;
    }

    
}

