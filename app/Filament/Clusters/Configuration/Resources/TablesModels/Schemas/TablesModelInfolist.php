<?php

namespace App\Filament\Clusters\Configuration\Resources\TablesModels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TablesModelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('table_number')
                    ->numeric(),
            ]);
    }
}
