<?php

namespace App\Filament\Resources\CaptainOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CaptainOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__("orders.code"))
                    ->searchable(),
                TextColumn::make('table.table_number')
                    ->label(__("orders.table-number"))
                    ->numeric(),
                TextColumn::make('customer.name')
                    ->label(__("orders.customer"))
                    ->default("---"),
                TextColumn::make('status')
                    ->label(__("orders.status"))
                    ->badge(),
                TextColumn::make('items_count')
                    ->label(__("orders.items"))
                    ->numeric(),
                TextColumn::make('total_price')
                    ->label(__("orders.total-price"))
                    ->numeric(),
                TextColumn::make('cacher.name')
                    ->label(__("orders.cacher")),
                TextColumn::make('created_at')
                    ->label(__("global.created-at"))
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->label(__("global.updated-at"))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
