<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Pages;

use App\Filament\Clusters\Configuration\Resources\TablesModels\TablesModelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTablesModel extends EditRecord
{
    protected static string $resource = TablesModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
