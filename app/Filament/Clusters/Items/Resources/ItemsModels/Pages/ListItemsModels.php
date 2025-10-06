<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListItemsModels extends ListRecords
{
    protected static string $resource = ItemsModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->closeModalByClickingAway(false)
                ->label(__("items.create-new"))
                ->modalHeading(__("items.create-new"))
        ];
    }
}
