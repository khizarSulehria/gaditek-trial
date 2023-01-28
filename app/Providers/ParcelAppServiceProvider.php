<?php

namespace App\Providers;

use App\Repositories\Interfaces\ParcelRepositoryInterface;
use App\Repositories\Interfaces\RiderRepositoryInterface;
use App\Repositories\ParcelRepository;
use App\Repositories\RiderRepository;
use App\Servcies\Interfaces\ParcelServiceInterface;
use App\Servcies\ParcelService;
use Illuminate\Support\ServiceProvider;

class ParcelAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind(
            RiderRepositoryInterface::class,
            RiderRepository::class
        );

        $this->app->bind(
            ParcelRepositoryInterface::class,
            ParcelRepository::class
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
