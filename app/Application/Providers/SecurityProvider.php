<?php

namespace App\Application\Providers;

use App\Core\Auth\Interfaces\TokenGenerator;
use App\Infrastructure\Security\Token\BcryptTokenGenerator;
use Illuminate\Support\ServiceProvider;

class SecurityProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TokenGenerator::class, BcryptTokenGenerator::class);
    }

    public function boot(): void {}
}
