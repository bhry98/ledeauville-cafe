<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels;

use App\Filament\Clusters\Configuration\ConfigurationCluster;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Pages\CreateTablesModel;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Pages\EditTablesModel;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Pages\ListTablesModels;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Pages\ViewTablesModel;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Schemas\TablesModelForm;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Schemas\TablesModelInfolist;
use App\Filament\Clusters\Configuration\Resources\TablesModels\Tables\TablesModelsTable;
use App\Models\tables\TablesModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TablesModelResource extends Resource
{
    protected static ?string $model = TablesModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    public static function getRoutePrefix(Panel $panel): string
    {
        return 'Tables';
    }

    protected static ?string $cluster = ConfigurationCluster::class;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return TablesModel::query()
//            ->withCount(['orders','todayOrders'])
            ->latest();
    }

    public static function getNavigationLabel(): string
    {
        return __('tables.tables');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tables.tables');
    }

    public static function form(Schema $schema): Schema
    {
        return TablesModelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TablesModelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TablesModelsTable::configure($table);
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
            'index' => ListTablesModels::route('/'),
            'view' => ViewTablesModel::route('/{record}'),
        ];
    }
}
