<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Table;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    
    protected function getHeaderActions(): array
    {
        
        return [
            Actions\DeleteAction::make(),
        ];
    }

    

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->actions([
    //             EditAction::make()
    //                 ->form([
    //                     TextInput::make('name')
    //                         ->required()
    //                         ->maxLength(255),
    //                     // ...
    //                 ]),
    //         ]);
    // }
}


