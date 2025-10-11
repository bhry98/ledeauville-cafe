<?php

namespace App\Filament\Resources\CaptainOrders\Pages;

use App\Filament\Resources\CaptainOrders\CaptainOrderResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

class ViewCaptainOrder extends ViewRecord
{
    protected static string $resource = CaptainOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('add_item')
                ->label(__("order.add-item"))
                ->closeModalByClickingAway(false)
                ->slideOver()
                ->schema([
                    Select::make('item_id')
                        ->label(__('order.item'))
                        ->relationship('items.item', 'name')
                        ->required()
                        ->getOptionLabelFromRecordUsing(fn($record) => "$record->name ( {$record->category?->name} )")
                        ->searchable()
                        ->preload(),
                    TextInput::make('amount')
                        ->label(__('order.amount'))
                        ->numeric()
                        ->minValue(1)
                        ->required()
                        ->default(1),
                    /**
                     * 'status',
                     * 'price',
                     * 'discount',
                     * 'final_price',
                     */
                ])
        ];
    }
}
