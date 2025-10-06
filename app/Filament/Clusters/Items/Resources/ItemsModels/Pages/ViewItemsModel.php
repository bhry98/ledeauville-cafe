<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewItemsModel extends ViewRecord
{
    protected static string $resource = ItemsModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
