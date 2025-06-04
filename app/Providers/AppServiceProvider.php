<?php

namespace App\Providers;

use App\Services\BrandService;
use App\Services\CarService;
use App\Services\OwnerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CarService::class, function ($app) {
            return new CarService();
        });

        $this->app->bind(OwnerService::class, function ($app) {
            return new OwnerService();
        });

        $this->app->bind(BrandService::class, function ($app) {
            return new BrandService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
