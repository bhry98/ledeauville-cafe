<?php

namespace App\Filament\Clusters\Items\Resources\ItemsModels\Pages;

use App\Filament\Clusters\Items\Resources\ItemsModels\ItemsModelResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemsModel extends CreateRecord
{
    protected static string $resource = ItemsModelResource::class;
}
