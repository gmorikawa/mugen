<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Language\Language;
use App\Core\Language\Interfaces\LanguageRepository;
use App\Infrastructure\Persistence\Models\LanguageModel;

class EloquentLanguageRepository implements LanguageRepository
{
    public function findAll(): array
    {
        $found = LanguageModel::all();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findById(string $id): Language | null
    {
        $found = LanguageModel::find($id);

        return $found
            ? $found->toObject()
            : null;
    }

    public function findByIsoCode(string $isoCode): Language | null
    {
        $found = LanguageModel::where('iso_code', $isoCode)->first();

        return $found
            ? $found->toObject()
            : null;
    }

    public function create(Language $language): Language
    {
        $model = new LanguageModel([
            'name' => $language->name,
            'iso_code' => $language->isoCode,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, Language $language): Language | null
    {
        $model = LanguageModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $language->name,
            'iso_code' => $language->isoCode
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = LanguageModel::find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }
}
