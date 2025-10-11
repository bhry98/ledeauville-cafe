<?php

namespace App\Filament\Resources\CaptainOrders\Pages;

use App\Filament\Resources\CaptainOrders\CaptainOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCaptainOrders extends ListRecords
{
    protected static string $resource = CaptainOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("orders.open-new-table"))
                ->modalHeading(__("orders.open-new-table"))
                ->closeModalByClickingAway(false)
        ];
    }
}
