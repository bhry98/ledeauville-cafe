<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Schemas;

use App\Models\items\ItemsModel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class ItemsModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label(__("items.code"))
                    ->maxLength(10)
                    ->required(fn($record) => $record)
                    ->unique((new ItemsModel())->getTable(), 'code'),
                TextInput::make('name')
                    ->label(__("items.name"))
                    ->maxLength(50)
                    ->autofocus()
                    ->required(),
                Select::make('category_id')
                    ->label(__("items.category"))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                TextInput::make('description')
                    ->string()
                    ->maxLength(200),
                ToggleButtons::make('is_active')
                    ->label(__("items.active"))
                    ->required()
                    ->boolean()
                    ->inline()
                    ->default(true),
                FileUpload::make('image')
                    ->label(__("items.image"))
                    ->nullable()
                    ->directory('items')
                    ->columnSpanFull(),
            ]);
    }
}
