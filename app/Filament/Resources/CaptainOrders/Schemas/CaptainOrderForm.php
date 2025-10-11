<?php

namespace App\Filament\Resources\CaptainOrders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CaptainOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('table')
                    ->label(__("orders.table"))
                    ->relationship('table', 'table_number', fn($query) => $query->whereDoesntHave('openOrder'))
                    ->getOptionLabelFromRecordUsing(fn($record) => "( #$record->table_number ) {$record->place?->name}")
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('customer')
                    ->label(__("orders.customer"))
                    ->relationship('customer', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                /**
                 * "payment_type",
                 * "price",
                 * "discount",
                 * "total_price",
                 * "created_at",
                 * "updated_at",
                 */
            ]);
    }
}
