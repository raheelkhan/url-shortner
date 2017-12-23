<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UrlService;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\StatController;
use App\Repositories\RepositoryInterface;
use App\Repositories\UrlRepository;
use App\Repositories\StatRepository;

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
        $this->app->bind(UrlService::class, function () {
            return new UrlService();
        });

        $this->app->when(UrlController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              return new UrlRepository;
          });

        $this->app->when(StatController::class)
          ->needs(RepositoryInterface::class)
          ->give(function () {
              return new StatRepository;
          });
    }
}
