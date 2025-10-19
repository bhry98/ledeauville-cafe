<?php

namespace App\Filament\Resources\CaptainOrders\Tables;

use App\Filament\Resources\CaptainOrders\RelationManagers\ItemsRelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\RelationManagerAction;

class CaptainOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__("orders.code"))
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('table.place.name')
                    ->label(__("orders.table-place")),
                TextColumn::make('table.table_number')
                    ->label(__("orders.table-number"))
                    ->numeric(),
                TextColumn::make('customer.name')
                    ->label(__("orders.customer"))
                    ->default("---"),
                TextColumn::make('status')
                    ->label(__("orders.status"))
                    ->badge()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('items_count')
                    ->label(__("orders.items"))
                    ->numeric(),
                TextColumn::make('items_sum_final_price')
                    ->label(__("orders.price"))
                    ->numeric()
                    ->default(0),
                TextColumn::make('cacher.name')
                    ->label(__("orders.cacher"))
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('created_at')
                    ->label(__("global.created-at"))
                    ->dateTime()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('updated_at')
                    ->label(__("global.updated-at"))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                RelationManagerAction::make('lesson-relation-manager')
                    ->label(__('orders.items'))
                    ->modalHeading(__('orders.items'))
                    ->icon(Heroicon::ShoppingBag)
                    ->slideOver()
                    ->modalWidth("full")
                    ->closeModalByClickingAway(false)
                    ->relationManager(ItemsRelationManager::make()),
//                ViewAction::make(),
//                EditAction::make(),
            ]);
    }
}
