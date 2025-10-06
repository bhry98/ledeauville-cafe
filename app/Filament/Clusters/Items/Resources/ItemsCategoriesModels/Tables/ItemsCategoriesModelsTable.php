<?php

namespace App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsCategoriesModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__("categories.code"))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__("categories.name"))
                    ->searchable(),
                TextColumn::make('items_count')
                    ->label(__("categories.items"))
                    ->numeric()
                    ->default(0),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                ->closeModalByClickingAway(false),
                DeleteAction::make(),
            ]);
    }
}
