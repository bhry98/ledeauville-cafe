<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TablesModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('place.name')
                    ->label(__("tables.place"))
                    ->searchable(),
                TextColumn::make('table_number')
                    ->label(__("tables.number"))
                    ->numeric(),
                TextColumn::make('orders_count')
                    ->label(__("tables.orders"))
                    ->numeric()
                    ->default(0),
                TextColumn::make('today_orders_count')
                    ->label(__("tables.today-orders"))
                    ->numeric()
                    ->default(0),
            ])
            ->filters([
                //
            ])
            ->recordActions([
//                ViewAction::make(),
                EditAction::make()
                    ->closeModalByClickingAway(false),
                DeleteAction::make()
                ->closeModalByClickingAway(false),
            ]);
    }
}
