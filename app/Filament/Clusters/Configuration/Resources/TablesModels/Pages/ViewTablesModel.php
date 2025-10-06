<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Pages;

use App\Filament\Clusters\Configuration\Resources\TablesModels\TablesModelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTablesModel extends ViewRecord
{
    protected static string $resource = TablesModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
