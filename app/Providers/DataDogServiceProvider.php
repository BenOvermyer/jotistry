<?php

namespace App\Providers;

use App\DataDog;
use Illuminate\Support\ServiceProvider;

class DataDogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( 'datadog', function () {
            return new DataDog;
        } );
    }
}
