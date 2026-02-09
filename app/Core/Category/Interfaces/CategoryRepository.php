<?php

namespace App\Core\Category\Interfaces;

use App\Core\Category\Category;

interface CategoryRepository
{
    public function findAll(): array;
    public function findByName(string $name): Category | null;
    public function findById(string $id): Category | null;
    public function create(Category $category): Category;
    public function update(string $id, Category $category): Category | null;
    public function delete(string $id): bool;
}