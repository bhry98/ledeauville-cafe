<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesPlaces;

use App\Filament\Clusters\Configuration\ConfigurationCluster;
use App\Filament\Clusters\Configuration\Resources\TablesPlaces\Pages\ListTablesPlaces;
use App\Filament\Clusters\Configuration\Resources\TablesPlaces\Schemas\TablesPlacesForm;
use App\Filament\Clusters\Configuration\Resources\TablesPlaces\Tables\TablesPlacesTable;
use App\Models\tables\TablesPlacesModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TablesPlacesResource extends Resource
{
    protected static ?string $model = TablesPlacesModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MapPin;

    protected static ?string $cluster = ConfigurationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getRoutePrefix(Panel $panel): string
    {
        return 'Places';
    }

    public static function getEloquentQuery(): Builder
    {
        return TablesPlacesModel::query()
            ->withCount('tables')
            ->latest();
    }

    public static function getNavigationLabel(): string
    {
        return __('places.places');
    }

    public static function getPluralModelLabel(): string
    {
        return __('places.label');
    }

    public static function form(Schema $schema): Schema
    {
        return TablesPlacesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TablesPlacesTable::configure($table);
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
            'index' => ListTablesPlaces::route('/'),
        ];
    }
}
