<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels;

use App\Filament\Clusters\Items\ItemsCluster;
use App\Filament\Clusters\Items\Resources\ItemsModels\Pages\CreateItemsModel;
use App\Filament\Clusters\Items\Resources\ItemsModels\Pages\EditItemsModel;
use App\Filament\Clusters\Items\Resources\ItemsModels\Pages\ListItemsModels;
use App\Filament\Clusters\Items\Resources\ItemsModels\Pages\ViewItemsModel;
use App\Filament\Clusters\Items\Resources\ItemsModels\Schemas\ItemsModelForm;
use App\Filament\Clusters\Items\Resources\ItemsModels\Schemas\ItemsModelInfolist;
use App\Filament\Clusters\Items\Resources\ItemsModels\Tables\ItemsModelsTable;
use App\Models\items\ItemsModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ItemsModelResource extends Resource
{
    protected static ?string $model = ItemsModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    protected static ?string $cluster = ItemsCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getRoutePrefix(Panel $panel): string
    {
        return 'Items';
    }

    public static function getEloquentQuery(): Builder
    {
        return ItemsModel::query()
//            ->withCount(['orders', 'todateOrders'])
            ->with(['category'])
            ->latest();
    }

    public static function form(Schema $schema): Schema
    {
        return ItemsModelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ItemsModelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemsModelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemsModels::route('/'),
            'view' => ViewItemsModel::route('/{record}'),
        ];
    }
}
