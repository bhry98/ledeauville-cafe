<?php

namespace App\Filament\Resources\CaptainOrders\Tables;

use App\Enums\orders\OrdersPaymentTypeEnum;
use App\Filament\Resources\CaptainOrders\RelationManagers\ItemsRelationManager;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\RelationManagerAction;
use Icetalker\FilamentTableRepeatableEntry\Infolists\Components\TableRepeatableEntry;

class CaptainOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__("orders.code"))
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('table.place.name')
                    ->label(__("orders.table-place")),
                TextColumn::make('table.table_number')
                    ->label(__("orders.table-number"))
                    ->numeric(),
                TextColumn::make('customer.name')
                    ->label(__("orders.customer"))
                    ->default(__("orders.default-customer")),
                TextColumn::make('status')
                    ->label(__("orders.status"))
                    ->badge()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('items_count')
                    ->label(__("orders.items"))
                    ->numeric(),
                TextColumn::make('items_sum_final_price')
                    ->label(__("orders.price"))
                    ->numeric()
                    ->default(0),
                TextColumn::make('cacher.name')
                    ->label(__("orders.cacher"))
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('created_at')
                    ->label(__("global.created-at"))
                    ->dateTime()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('updated_at')
                    ->label(__("global.updated-at"))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                RelationManagerAction::make('lesson-relation-manager')
                    ->label(__('orders.items'))
                    ->modalHeading(__('orders.items'))
                    ->icon(Heroicon::ShoppingBag)
                    ->slideOver()
                    ->modalWidth("full")
                    ->closeModalByClickingAway(false)
                    ->relationManager(ItemsRelationManager::make()),
                Action::make("checkout")
                    ->label(__('orders.checkout'))
                    ->modalHeading(__('orders.checkout'))
                    ->slideOver()
                    ->modalWidth("full")
                    ->closeModalByClickingAway(false)
                    ->schema([
                        Section::make('')
                            ->columns(2)
                            ->schema([
                                Section::make('')
                                    ->columnSpan(1)
                                    ->schema([
                                        TextEntry::make('table.table_number')
                                            ->label(__("orders.table"))
                                            ->getStateUsing(fn($record) => "#{$record?->table->table_number} ({$record?->table->place?->name})")
                                            ->inlineLabel(),
                                        TextEntry::make('customer.name')
                                            ->label(__("orders.customer"))
                                            ->default(__("orders.default-customer"))
                                            ->inlineLabel(),
                                        TextEntry::make('cacher.name')
                                            ->label(__("orders.cacher"))
                                            ->default(__("orders.default-cacher"))
                                            ->inlineLabel(),
                                        TextInput::make('total_price')
                                            ->label(__("orders.total-price"))
                                            ->numeric()
                                            ->default(fn($record) => $record->items_sum_final_price ?? 0)
                                            ->disabled(),
                                        TextInput::make('discount')
                                            ->label(__("orders.discount"))
                                            ->numeric()
                                            ->default(0)
                                            ->afterStateUpdated(function ($record, Set $set, $state) {
                                                $price = $record->items_sum_final_price ?? 0;
                                                $discount = $state ?? 0;
                                                $finalPrice = $price - ($price * $discount / 100);
                                                $set('final_price', round($finalPrice, 2));
                                            })
                                            ->prefixIcon(Heroicon::ReceiptPercent)
                                            ->required()
                                            ->live(debounce: 100)
                                            ->minValue(0)
                                            ->maxValue(100),
                                        TextInput::make('final_price')
                                            ->label(__("orders.final-price"))
                                            ->numeric()
                                            ->default(fn($record) => $record->items_sum_final_price)
                                            ->disabled()
                                            ->dehydrated()
                                            ->minValue(0),
                                        ToggleButtons::make('payment_type')
                                            ->label(__("orders.payment-type"))
                                            ->options(
                                                collect(OrdersPaymentTypeEnum::cases())
                                                    ->mapWithKeys(fn($case) => [$case->name => $case->getLabel()])
                                                    ->toArray()
                                            )
                                            ->icons(
                                                collect(OrdersPaymentTypeEnum::cases())
                                                    ->mapWithKeys(fn($case) => [$case->name => $case->getIcon()])
                                                    ->toArray()
                                            )
                                            ->colors(
                                                collect(OrdersPaymentTypeEnum::cases())
                                                    ->mapWithKeys(fn($case) => [$case->name => $case->getColor()])
                                                    ->toArray()
                                            )
                                            ->default(OrdersPaymentTypeEnum::Cache->name)
                                            ->required()
                                            ->inline(),

                                    ]),
                                TableRepeatableEntry::make('items')
                                    ->label(__('orders.items'))
                                    ->schema([
                                        TextEntry::make('item.name')
                                            ->label(__("items.name")),
                                        TextEntry::make('price')
                                            ->label(__("orders.price"))
                                            ->numeric(),
                                        TextEntry::make('amount')
                                            ->label(__("orders.amount"))
                                            ->numeric(),
                                        TextEntry::make('final_price')
                                            ->label(__("orders.total-price"))
                                            ->numeric()
                                    ])
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->icon(Heroicon::Printer)
                    ->color(Color::Red)
                    ->action(function ($record, array $data, $livewire) {
                        // Optional: Save payment type, discount, etc.
//                        $record->update([
//                            'payment_type' => $data['payment_type'] ?? null,
//                            'discount' => $data['discount'] ?? 0,
//                            'final_price' => $data['final_price'] ?? $record->items_sum_final_price,
//                        ]);

                        // Return JS to open print window
                        $printUrl = route('orders-print-receipt', $record->code);

                        // Use Filament's JavaScript redirect to open new window
//                        $livewire->js("window.open('{$printUrl}', '_blank', 'width=800,height=600');");
                        $livewire->js("if (window.electronAPI) {
                                        window.electronAPI.printReceipt('/orders/{$record->id}/print');
                                    } else {
                                        window.open('/orders/{$record->id}/print', '_blank').print();
                                    }");

                    }),
//                ViewAction::make(),
//                EditAction::make(),
            ]);
    }
}
