<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesPlaces\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TablesPlacesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__("places.name"))
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull(),
            ]);
    }
}
