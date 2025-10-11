<?php

namespace App\Filament\Resources\CaptainOrders;

use App\Enums\orders\OrdersStatusEnum;
use App\Filament\Resources\CaptainOrders\Pages\CreateCaptainOrder;
use App\Filament\Resources\CaptainOrders\Pages\EditCaptainOrder;
use App\Filament\Resources\CaptainOrders\Pages\ListCaptainOrders;
use App\Filament\Resources\CaptainOrders\Pages\ViewCaptainOrder;
use App\Filament\Resources\CaptainOrders\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\CaptainOrders\Schemas\CaptainOrderForm;
use App\Filament\Resources\CaptainOrders\Schemas\CaptainOrderInfolist;
use App\Filament\Resources\CaptainOrders\Tables\CaptainOrdersTable;
use App\Models\CaptainOrder;
use App\Models\orders\OrdersModel;
use App\Models\tables\TablesModel;
use BackedEnum;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CaptainOrderResource extends Resource
{
    protected static ?string $model = OrdersModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    public static function getRoutePrefix(Panel $panel): string
    {
        return 'Captain-Orders';
    }

    public static function getNavigationLabel(): string
    {
        return __('orders.captain-order');
    }

    public static function getPluralLabel(): ?string
    {
        return __('orders.captain-order');
    }

    public static function getEloquentQuery(): Builder
    {
        return OrdersModel::query()
            ->where([
                "status" => OrdersStatusEnum::Open,
            ])
            ->withCount([
                'items'
            ])
            ->withSum('items', 'final_price')
            ->with([
                'table',
                'customer',
                'cacher',
            ])
            ->latest();
    }

    public static function form(Schema $schema): Schema
    {
        return CaptainOrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CaptainOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CaptainOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            'items' => ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCaptainOrders::route('/'),
//            'create' => CreateCaptainOrder::route('/c'),
            'view' => ViewCaptainOrder::route('/{record}'),
        ];
    }
}
