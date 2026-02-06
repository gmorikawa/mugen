<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\File\Interfaces\FileRepository;
use App\Core\File\File;
use App\Infrastructure\Persistence\Models\FileModel;
use Exception;

class EloquentFileRepository implements FileRepository
{
    public function findAll(): array
    {
        $found = FileModel::all();

        return $found->map(function ($item) {
            return new File([
                'id' => $item->id,
                'name' => $item->name,
                'path' => $item->path,
                'state' => $item->state,
            ]);
        })->toArray();
    }

    public function findById(String $id): File | null
    {
        $found = FileModel::find($id);

        return $found
            ? new File([
                'id' => $found->id,
                'name' => $found->name,
                'path' => $found->path,
                'state' => $found->state,
            ])
            : null;
    }

    public function create(File $entity): File
    {
        $model = new FileModel([
            'name' => $entity->name,
            'path' => $entity->path,
            'state' => $entity->state,
        ]);

        $model->save();

        return new File([
            'id' => $model->id,
            'name' => $model->name,
            'path' => $model->path,
            'state' => $model->state,
        ]);
    }

    public function update(String $id, File $entity): File
    {
        $model = FileModel::find($id);

        if (!$model) {
            throw new Exception('File not found');
        }

        $model->update([
            'name' => $entity->name,
            'path' => $entity->path,
            'state' => $entity->state,
        ]);

        return new File([
            'id' => $model->id,
            'name' => $model->name,
            'path' => $model->path,
            'state' => $model->state
        ]);
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
