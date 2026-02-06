<?php

namespace App\Application\Providers;

use App\Core\File\Interfaces\Storage;
use App\Infrastructure\Storage\LocalStorage;
use Illuminate\Support\ServiceProvider;

class StorageProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Storage::class, LocalStorage::class);
    }

    public function boot(): void {}
}
