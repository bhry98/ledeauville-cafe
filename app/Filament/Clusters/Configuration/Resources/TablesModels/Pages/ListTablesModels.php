<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Pages;

use App\Filament\Clusters\Configuration\Resources\TablesModels\TablesModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTablesModels extends ListRecords
{
    protected static string $resource = TablesModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("tables.create-new"))
                ->modalHeading(__("tables.create-new"))
                ->createAnother(false)
                ->closeModalByClickingAway(false)

        ];
    }
}
