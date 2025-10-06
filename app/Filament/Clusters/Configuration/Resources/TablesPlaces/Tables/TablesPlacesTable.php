<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesPlaces\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TablesPlacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__("places.code"))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__("places.name"))
                    ->searchable(),
                TextColumn::make('tables_count')
                    ->label(__("places.tables"))
                    ->numeric()
                    ->default(0),
                TextColumn::make('orders_count')
                    ->label(__("places.orders"))
                    ->numeric()
                    ->default(0),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->closeModalByClickingAway(false),
                DeleteAction::make()
                    ->closeModalByClickingAway(false),
            ]);
    }
}
