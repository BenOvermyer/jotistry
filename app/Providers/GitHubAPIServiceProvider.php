<?php

namespace App\Providers;

use App\GitHubAPI;
use Illuminate\Support\ServiceProvider;

class GitHubAPIServiceProvider extends ServiceProvider
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
        $this->app->singleton( 'githubapi', function () {
            return new GitHubAPI;
        } );
    }
}
