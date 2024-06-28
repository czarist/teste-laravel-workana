<?php

namespace App\Providers;

use App\Services\CepService;
use Illuminate\Support\ServiceProvider;

class CepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CepService::class, function ($app) {
            return new CepService();
        });
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
