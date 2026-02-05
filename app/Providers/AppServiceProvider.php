<?php

namespace App\Providers;

use App\Core\User\UserRepository;
use App\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function (Application $app) {
            return new EloquentUserRepository();
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
