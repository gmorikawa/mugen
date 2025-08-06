<?php

namespace App\Services;

use App\Models\File;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    function write(File $file, $stream)
    {
        return Storage::disk('local')
            ->putFileAs($file->path, $stream, $file->name);
    }

    function read(File $file)
    {
        return Storage::download($file->file_path, $file->name);
    }

    function exists(File $file)
    {
        return Storage::disk('local')->exists($file->file_path);
    }

    function remove(File $file)
    {
        return Storage::delete($file->file_path);
    }
}
