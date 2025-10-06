<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditItemsModel extends EditRecord
{
    protected static string $resource = ItemsModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
