<?php

namespace MBozwood\IPBoardApi;

use Illuminate\Support\ServiceProvider;

class IpboardApiLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/ipboard_api.php' => config_path('ipboard_api.php')
        ], 'config');
    }
}
