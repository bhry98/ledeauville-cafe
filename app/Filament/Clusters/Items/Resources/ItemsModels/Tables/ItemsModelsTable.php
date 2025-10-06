<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__("items.image"))
                    ->circular(),
                TextColumn::make('code')
                    ->label(__("items.code"))
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label(__("items.category"))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__("items.name"))
                    ->searchable(),
                TextColumn::make('price')
                    ->label(__("items.price"))
                    ->numeric(),
                IconColumn::make('is_active')
                    ->label(__("items.active"))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
//                ViewAction::make(),
                EditAction::make()
                    ->closeModalByClickingAway(false),
            ]);
    }
}
