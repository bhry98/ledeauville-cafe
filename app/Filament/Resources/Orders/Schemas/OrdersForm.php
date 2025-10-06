<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        //Captain Order
        return $schema
            ->components([
                Select::make('table_id')
                    ->label(__("orders.table_id"))
                    ->required()
                    ->relationship('table', 'table_number')
                /**
                 * "cacher_id",
                 * "customer_id",
                 * "status",
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
