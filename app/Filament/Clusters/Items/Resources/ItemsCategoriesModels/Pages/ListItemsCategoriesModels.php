<?php

namespace App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsCategoriesModels\ItemsCategoriesModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListItemsCategoriesModels extends ListRecords
{
    protected static string $resource = ItemsCategoriesModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("categories.create-new"))
                ->modalHeading(__("categories.create-new"))
                ->createAnother(false)
                ->closeModalByClickingAway(false)
        ];
    }
}
