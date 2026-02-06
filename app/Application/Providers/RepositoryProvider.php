<?php

namespace App\Application\Providers;

use App\Core\File\Interfaces\FileRepository;
use App\Core\User\UserRepository;
use App\Infrastructure\Persistence\Repositories\EloquentFileRepository;
use App\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(FileRepository::class, EloquentFileRepository::class);
    }

    public function boot(): void {}
}
