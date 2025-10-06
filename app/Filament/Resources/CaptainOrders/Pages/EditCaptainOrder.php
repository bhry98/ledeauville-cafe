<?php

namespace App\Filament\Resources\CaptainOrders\Pages;

use App\Filament\Resources\CaptainOrders\CaptainOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCaptainOrder extends EditRecord
{
    protected static string $resource = CaptainOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
