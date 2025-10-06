<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Schemas;

use App\Models\tables\TablesModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TablesModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('table_place_id')
                    ->label(__("tables.place"))
                    ->required()
                    ->relationship('place', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('table_number')
                    ->required()
                    ->numeric()
                    ->unique((new TablesModel())->getTable(), 'table_number'),
            ]);
    }
}
