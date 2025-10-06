<?php

namespace App\Filament\Clusters\Items;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class ItemsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    public static function getNavigationLabel(): string
    {
        return __("items.items");
    }
}
