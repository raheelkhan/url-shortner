<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UrlService;
use App\Repositories\UrlRepository;
use App\Repositories\StatRepository;
use App\Services\UrlApi;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(UrlApi::class, function () {
            return new UrlApi(new UrlService(), new UrlRepository());
        });
    }
}