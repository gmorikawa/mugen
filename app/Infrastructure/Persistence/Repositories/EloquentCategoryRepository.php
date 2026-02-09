<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Category\Interfaces\CategoryRepository;
use App\Core\Category\Category;
use App\Infrastructure\Persistence\Models\CategoryModel;

class EloquentCategoryRepository implements CategoryRepository
{
    public function findAll(): array
    {
        $found = CategoryModel::all();

        return $found->map(function ($item) {
            return $item->toObject();
        })->toArray();
    }

    public function findByName(string $name): Category | null
    {
        $found = CategoryModel::where('name', $name)->first();

        return $found
            ? $found->toObject()
            : null;
    }

    public function findById(string $id): Category | null
    {
        $found = CategoryModel::find($id);

        return $found
            ? $found->toObject()
            : null;
    }

    public function create(Category $category): Category
    {
        $model = new CategoryModel([
            'name' => $category->name,
            'description' => $category->description,
        ]);

        $model->save();

        return $model->toObject();
    }

    public function update(string $id, Category $category): Category | null
    {
        $model = CategoryModel::find($id);

        if (!$model) {
            return null;
        }

        $model->update([
            'name' => $category->name,
            'description' => $category->description,
        ]);

        return $model->toObject();
    }

    public function delete(string $id): bool
    {
        $model = CategoryModel::find($id);
        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
