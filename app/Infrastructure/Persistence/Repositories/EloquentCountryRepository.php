<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Country\Interfaces\CountryRepository;
use App\Core\Country\Country;
use App\Infrastructure\Persistence\Models\CountryModel;

class EloquentCountryRepository implements CountryRepository
{
    public function findAll(): array
    {
        $found = CountryModel::with('flag')->get();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findById(string $id): Country | null
    {
        $found = CountryModel::with('flag')->find($id);

        return $found
            ? $found->toObject()
            : null;
    }

    public function create(Country $country): Country
    {
        $model = new CountryModel([
            'name' => $country->name,
            'flag_id' => $country->flag?->id,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, Country $country): Country | null
    {
        $model = CountryModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $country->name,
            'flag_id' => $country->flag?->id,
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = CountryModel::find($id);
        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
