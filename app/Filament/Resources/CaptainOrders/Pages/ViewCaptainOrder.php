<?php

namespace App\Filament\Resources\CaptainOrders\Pages;

use App\Filament\Resources\CaptainOrders\CaptainOrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCaptainOrder extends ViewRecord
{
    protected static string $resource = CaptainOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
