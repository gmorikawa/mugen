<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Company\Company;
use App\Core\Company\Interfaces\CompanyRepository;
use App\Infrastructure\Persistence\Models\CompanyModel;

class EloquentCompanyRepository implements CompanyRepository
{
    public function findAll(): array
    {
        $found = CompanyModel::with('country.flag')->get();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findById(string $id): Company | null
    {
        $found = CompanyModel::with('country.flag')->find($id);

        return $found ? $found->toObject() : null;
    }

    public function create(Company $company): Company
    {
        $model = new CompanyModel([
            'name' => $company->name,
            'country_id' => $company->country?->id,
            'description' => $company->description,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, Company $company): Company | null
    {
        $model = CompanyModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $company->name,
            'country_id' => $company->country?->id,
            'description' => $company->description,
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = CompanyModel::find($id);
        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
