<?php

namespace App\Filament\Resources\CaptainOrders\RelationManagers;

use App\Enums\orders\OrdersItemsStatusEnum;
use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use App\Models\items\ItemsModel;
use App\Models\orders\OrdersItemsModel;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $relatedResource = ItemsModelResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('item.image')
                    ->label(__("items.image"))
                    ->circular(),
                TextColumn::make('item.name')
                    ->label(__("items.name"))
                    ->searchable(),
                TextColumn::make('price')
                    ->label(__("orders.price"))
                    ->numeric(),
                TextColumn::make('amount')
                    ->label(__("orders.amount"))
                    ->numeric(),
                TextColumn::make('discount')
                    ->label(__("orders.discount"))
                    ->numeric(),
                TextColumn::make('final_price')
                    ->label(__("orders.final-price"))
                    ->numeric(),
                TextColumn::make('status')
                    ->label(__("orders.status"))
                    ->badge(),
                TextColumn::make('note')
                    ->label(__("orders.note"))
                    ->default("---"),
            ])
            ->headerActions([
                CreateAction::make()
                    ->schema([
                        Grid::make()
                            ->columns()
                            ->schema([
                                Select::make('item_id')
                                    ->label(__("orders.item"))
                                    ->relationship('item', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        if ($item = ItemsModel::query()->find($state)) {
                                            $price = $item->price ?? 0;
                                            $discount = $get('discount') ?? 0;
                                            $amount = $get('amount') ?? 1;
                                            $finalPrice = ($price * $amount) - (($price * $amount) * $discount / 100);
                                            $set('price', $price);
                                            $set('final_price', round($finalPrice, 2));
                                        }
                                    })
                                    ->required(),
                                TextInput::make('price')
                                    ->label(__("orders.price"))
                                    ->numeric()
                                    ->minValue(0)
                                    ->afterStateUpdated(function (Set $set, Get $get) {
                                        $price = $get('price') ?? 0;
                                        $discount = $get('discount') ?? 0;
                                        $amount = $get('amount') ?? 1;
                                        $finalPrice = ($price * $amount) - (($price * $amount) * $discount / 100);
                                        $set('final_price', round($finalPrice, 2));
                                    })
                                    ->required(),
                                TextInput::make('amount')
                                    ->label(__("orders.amount"))
                                    ->default(1)
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, Get $get) {
                                        $price = $get('price') ?? 0;
                                        $discount = $get('discount') ?? 0;
                                        $amount = $get('amount') ?? 1;
                                        $finalPrice = ($price * $amount) - (($price * $amount) * $discount / 100);
                                        $set('final_price', round($finalPrice, 2));
                                    })
                                    ->required()
                                    ->minValue(1),
                                TextInput::make('discount')
                                    ->label(__("orders.discount"))
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, Get $get) {
                                        $price = $get('price') ?? 0;
                                        $discount = $get('discount') ?? 0;
                                        $amount = $get('amount') ?? 1;
                                        $finalPrice = ($price * $amount) - (($price * $amount) * $discount / 100);
                                        $set('final_price', round($finalPrice, 2));
                                    })
                                    ->prefixIcon(Heroicon::ReceiptPercent)
                                    ->required(),
                                TextInput::make('final_price')
                                    ->label(__("orders.final-price"))
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                                ToggleButtons::make('status')
                                    ->label(__("orders.status"))
                                    ->options([
                                        "Preparing" => __("orders.status-label.preparing"),
                                        "Delivered" => __("orders.status-label.delivered"),
                                        "Cancelled" => __("orders.status-label.cancelled"),
                                    ])
                                    ->default(OrdersItemsStatusEnum::Preparing->name)
                                    ->inline()
                                    ->required(),
                                TextInput::make('note')
                                    ->label(__("orders.note"))
                                    ->string()
                                    ->nullable()
                                    ->columnSpanFull()
                                    ->maxLength(200),
                            ])
                    ]),
            ]);
    }
}
