<?php

namespace App\Core\Category;

use App\Core\Category\Exceptions\DuplicatedCategoryNameException;
use App\Core\Category\Interfaces\CategoryRepository;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function create(Category $entity)
    {
        if (!$this->isNameUnique($entity->name)) {
            throw new DuplicatedCategoryNameException();
        }

        return $this->repository->create($entity);
    }

    public function update(string $id, Category $entity)
    {
        if (!$this->isNameUnique($entity->name, $id)) {
            throw new DuplicatedCategoryNameException();
        }

        $category = $this->repository->findById($id);

        if (!$category) {
            return null;
        }

        return $this->repository->update(
            $id,
            new Category([
                'id' => $id,
                'name' => $entity->name,
                'description' => $entity->description,
            ])
        );
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    private function isNameUnique(string $name, string $ignoreId = ''): bool
    {
        $found = $this->repository->findByName($name);

        if ($found && $found->id !== $ignoreId) {
            return false;
        }

        return true;
    }
}
