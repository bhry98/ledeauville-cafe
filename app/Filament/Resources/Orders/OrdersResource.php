<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrders;
use App\Filament\Resources\Orders\Pages\EditOrders;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Schemas\OrdersForm;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Orders;
use App\Models\orders\OrdersModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrdersResource extends Resource
{
    protected static ?string $model = OrdersModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'code';

    public static function getRoutePrefix(Panel $panel): string
    {
        return 'Orders';
    }

    public static function getNavigationLabel(): string
    {
        return __("orders.orders");
    }

    public static function getEloquentQuery(): Builder
    {
        return OrdersModel::query()
//            ->withCount(['items'])
            ->latest();
    }

    public static function form(Schema $schema): Schema
    {
        return OrdersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrders::route('/create'),
            'edit' => EditOrders::route('/{record}/edit'),
        ];
    }
}
