<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\File\Interfaces\FileRepository;
use App\Core\File\File;
use App\Infrastructure\Persistence\Models\FileModel;

class EloquentFileRepository implements FileRepository
{
    public function findAll(): array
    {
        $found = FileModel::all();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findById(String $id): File | null
    {
        $found = FileModel::find($id);

        return $found
            ? $found->toObject()
            : null;
    }

    public function create(File $entity): File
    {
        $model = new FileModel([
            'name' => $entity->name,
            'path' => $entity->path,
            'state' => $entity->state->value,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(String $id, File $entity): File | null
    {
        $model = FileModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $entity->name,
            'path' => $entity->path,
            'state' => $entity->state->value,
        ]);

        return $model->toObject();
    }

    public function delete(String $id): bool
    {
        $model = FileModel::find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }
}
