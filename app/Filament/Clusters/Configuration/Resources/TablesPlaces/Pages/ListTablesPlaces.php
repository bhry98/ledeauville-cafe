<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesPlaces\Pages;

use App\Filament\Clusters\Configuration\Resources\TablesPlaces\TablesPlacesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTablesPlaces extends ListRecords
{
    protected static string $resource = TablesPlacesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("places.create-new"))
                ->modalHeading(__("places.create-new"))
                ->createAnother(false)
                ->closeModalByClickingAway(false)
        ];
    }
}
