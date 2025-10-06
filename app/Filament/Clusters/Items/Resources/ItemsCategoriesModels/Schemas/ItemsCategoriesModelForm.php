<?php

namespace App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemsCategoriesModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__("categories.name"))
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull(),
            ]);
    }
}
