<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom([
            database_path("migrations{$ds}users"),
            database_path("migrations{$ds}system"),
            database_path("migrations{$ds}tables"),
            database_path("migrations{$ds}items"),
            database_path("migrations{$ds}orders"),
        ]);
    }
}
