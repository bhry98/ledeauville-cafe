<?php

namespace App\Filament\Resources\CaptainOrders\RelationManagers;

use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use App\Models\orders\OrdersItemsModel;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $relatedResource = ItemsModelResource::class;
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->schema([
                        Select::make('item_id')
                            ->relationship('item', 'name')
                            ->required(),
                    ]),
            ]);
    }
}
