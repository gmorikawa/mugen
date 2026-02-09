<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Platform\Platform;
use App\Core\Platform\Interfaces\PlatformRepository;
use App\Infrastructure\Persistence\Models\PlatformModel;

class EloquentPlatformRepository implements PlatformRepository
{
    public function findAll(): array
    {
        $found = PlatformModel::with([
            'developer.country.flag',
            'manufacturer.country.flag'
        ])->get();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findByName(string $name): Platform | null
    {
        $found = PlatformModel::where('name', $name)->first();

        return $found
            ? $found->toObject()
            : null;
    }

    public function findByAbbreviation(string $abbreviation): ?Platform
    {
        $found = PlatformModel::where('abbreviation', $abbreviation)->first();

        return $found
            ? $found->toObject()
            : null;
    }

    public function findById(string $id): Platform | null
    {
        $found = PlatformModel::with([
            'developer.country.flag',
            'manufacturer.country.flag'
        ])->find($id);

        return $found ? $found->toObject() : null;
    }

    public function create(Platform $platform): Platform
    {
        $model = new PlatformModel([
            'name' => $platform->name,
            'abbreviation' => $platform->abbreviation,
            'type' => $platform->type->value,
            'developer_id' => $platform->developer?->id,
            'manufacturer_id' => $platform->manufacturer?->id,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, Platform $platform): Platform | null
    {
        $model = PlatformModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $platform->name,
            'abbreviation' => $platform->abbreviation,
            'type' => $platform->type->value,
            'developer_id' => $platform->developer?->id,
            'manufacturer_id' => $platform->manufacturer?->id,
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = PlatformModel::find($id);
        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
