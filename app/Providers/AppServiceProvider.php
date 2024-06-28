<?php

namespace App\Providers;

use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use App\Services\PasswordResetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PasswordResetService::class, function ($app) {
            return new PasswordResetService($app->make(PasswordResetRepository::class));
        });

        $this->app->singleton(PasswordResetRepository::class, function ($app) {
            return new PasswordResetRepository();
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository();
        });
    }

    public function boot()
    {
        //
    }
}
