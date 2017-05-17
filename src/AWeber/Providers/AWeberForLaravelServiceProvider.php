<?php

namespace Aweber\Providers;

use Illuminate\Support\ServiceProvider;

class AWeberForLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/' => config_path()]);
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/aweber.php', 'aweber');
    }
}
