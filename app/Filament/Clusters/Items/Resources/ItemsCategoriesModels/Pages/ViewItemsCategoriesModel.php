<?php

namespace App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\ItemsCategoriesModelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewItemsCategoriesModel extends ViewRecord
{
    protected static string $resource = ItemsCategoriesModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
