<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\GymRepositoryInterface;
use App\Repositories\Contracts\SubscribePackageRepositoryInterface;
use App\Repositories\GymRepository;
use App\Repositories\SubscribePackageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->singleton(CityRepositoryInterface::class, CityRepository::class);
        $this->app->singleton(GymRepositoryInterface::class, GymRepository::class);
        $this->app->singleton(SubscribePackageRepositoryInterface::class, SubscribePackageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
