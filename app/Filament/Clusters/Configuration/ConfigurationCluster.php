<?php

namespace App\Filament\Clusters\Configuration;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Panel;
use Filament\Support\Icons\Heroicon;

class ConfigurationCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    public static function getNavigationLabel(): string
    {
        return __('global.configuration');
    }
    public static function getRoutePath(Panel $panel): string
    {
        return 'Configuration';
    }


}
