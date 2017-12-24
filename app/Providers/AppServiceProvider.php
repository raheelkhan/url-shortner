<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UrlService;
use App\Repositories\UrlRepository;
use App\Repositories\StatRepository;
use App\Services\UrlApi;
use App\Http\Controllers\IndexController;
use App\Repositories\RepositoryInterface;
use App\Http\Controllers\StatController;

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

        $this->app->when(IndexController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              return new StatRepository();
          });

        $this->app->when(StatController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              return new StatRepository();
          });
    }
}