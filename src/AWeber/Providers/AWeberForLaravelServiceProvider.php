<?php

namespace AWeberForLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class AWeberForLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/' => config_path()]);
        $this->publishes([__DIR__.'/../../migrations/CreateAWeberTables.php' => base_path('database/migrations/CreateAWeberTables.php')]);
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/aweber.php', 'aweber');
    }
}
