<?php

namespace App\Providers;

use App\Services\FutebolApiService;
use App\Services\FutebolApiServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FutebolApiServiceInterface::class, FutebolApiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
