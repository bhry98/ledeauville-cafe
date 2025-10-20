<?php

namespace App\Filament\Resources\CaptainOrders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class CaptainOrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns(4)
                    ->schema([
                        TextEntry::make('table.table_number')
                            ->label(__('orders.table'))
                            ->weight(FontWeight::Bold)
                            ->getStateUsing(fn($record) => "( #{$record->table?->table_number} ) {$record->table?->place?->name}"),
                        TextEntry::make('customer')
                            ->label(__('orders.customer'))
                            ->weight(FontWeight::Bold)
                            ->getStateUsing(fn($record) => $record->customer ? "( #{$record->customer?->phone_number} ) {$record->customer?->display_name}" : __("orders.default-customer")),
                        TextEntry::make('items_count')
                            ->label(__('orders.items'))
                            ->numeric()
                            ->default(0)
                            ->weight(FontWeight::Bold),
                        TextEntry::make('items_sum_final_price')
                            ->label(__('orders.total-price'))
                            ->numeric()
                            ->default(0)
                            ->weight(FontWeight::Bold),
                    ])
            ]);
    }
}
