<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use CloudCreativity\LaravelJsonApi\LaravelJsonApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (config('app.current_server') === 'heroku') {
            $url->forceScheme('https');
        }

        LaravelJsonApi::defaultApi('v1');
    }
}
