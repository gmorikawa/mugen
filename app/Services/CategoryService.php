<?php

namespace App\Services;

use App\Exceptions\Category\DuplicatedCategoryNameException;
use App\Models\Category;

class CategoryService
{
    function getAll()
    {
        return Category::all();
    }

    function getById(String $id)
    {
        return Category::find($id);
    }

    function getByName(String $name)
    {
        return Category::where('name', $name)->first();
    }

    function create(Category $entity)
    {
        if (!$this->isNameUnique($entity->name)) {
            throw new DuplicatedCategoryNameException();
        }

        $entity->save();

        return $entity;
    }

    function update(String $id, Category $entity)
    {
        if (!$this->isNameUnique($entity->name, $id)) {
            throw new DuplicatedCategoryNameException();
        }

        $category = $this->getById($id);

        if ($category) {
            $category->name = $entity->name;
            $category->description = $entity->description;

            $category->save();
        }

        return $category;
    }

    function remove(String $id)
    {
        return Category::destroy($id);
    }

    function isNameUnique(String $name, String $ignoreId = '')
    {
        $platform = $this->getByName($name);

        return is_null($platform) || $platform->id == $ignoreId;
    }
}
