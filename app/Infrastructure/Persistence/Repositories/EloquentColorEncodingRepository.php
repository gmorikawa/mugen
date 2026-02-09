<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\ColorEncoding\ColorEncoding;
use App\Core\ColorEncoding\Interfaces\ColorEncodingRepository;
use App\Infrastructure\Persistence\Models\ColorEncodingModel;

class EloquentColorEncodingRepository implements ColorEncodingRepository
{
    public function findAll(): array
    {
        $found = ColorEncodingModel::all();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findById(string $id): ColorEncoding | null
    {
        $found = ColorEncodingModel::find($id);

        return $found
            ? $found->toObject()
            : null;
    }

    public function create(ColorEncoding $colorEncoding): ColorEncoding
    {
        $model = new ColorEncodingModel([
            'name' => $colorEncoding->name,
            'description' => $colorEncoding->description,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, ColorEncoding $colorEncoding): ColorEncoding | null
    {
        $model = ColorEncodingModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $colorEncoding->name,
            'description' => $colorEncoding->description,
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = ColorEncodingModel::find($id);
        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
