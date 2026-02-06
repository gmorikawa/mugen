<?php

namespace App\Infrastructure\Storage;

use App\Core\File\File;
use App\Core\File\Interfaces\Storage;

use Illuminate\Support\Facades\Storage as LaravelStorage;

class LocalStorage implements Storage
{
    function exists(File $file): bool
    {
        return LaravelStorage::disk('local')->exists($file->path);
    }

    function write(File $file, $stream): bool
    {
        return LaravelStorage::disk('local')
            ->putFileAs($file->path, $stream, $file->name);
    }

    function read(File $file): mixed
    {
        return LaravelStorage::download($file->path, $file->name);
    }

    function delete(File $file): bool
    {
        return LaravelStorage::disk('local')->delete($file->path);
    }
}