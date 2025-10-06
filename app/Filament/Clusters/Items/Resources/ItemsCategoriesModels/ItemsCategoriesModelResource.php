<?php

namespace App\Filament\Clusters\Items\Resources\ItemsCategoriesModels;

use App\Filament\Clusters\Items\ItemsCluster;
use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Pages\ListItemsCategoriesModels;
use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Pages\ViewItemsCategoriesModel;
use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Schemas\ItemsCategoriesModelForm;
use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Schemas\ItemsCategoriesModelInfolist;
use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Tables\ItemsCategoriesModelsTable;
use App\Models\items\ItemsCategoriesModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ItemsCategoriesModelResource extends Resource
{
    protected static ?string $model = ItemsCategoriesModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $cluster = ItemsCluster::class;

    public static function getRoutePrefix(Panel $panel): string
    {
        return "Categories";
    }

    public static function getNavigationLabel(): string
    {
        return __('categories.categories');
    }

    public static function getEloquentQuery(): Builder
    {
        return ItemsCategoriesModel::query()
            ->withCount(['items'])
            ->latest();
    }

    public static function form(Schema $schema): Schema
    {
        return ItemsCategoriesModelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ItemsCategoriesModelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemsCategoriesModelsTable::configure($table);
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
            'index' => ListItemsCategoriesModels::route('/'),
            'view' => ViewItemsCategoriesModel::route('/{record}'),
        ];
    }
}
