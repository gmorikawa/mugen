<?php

namespace App\Application\Controller\API;

use App\Core\Category\Category;
use App\Core\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends APIController
{
    public function __construct(
        protected CategoryService $service
    ) {}

    public function getAll()
    {
        $categories = $this->service->getAll();

        return array_map(function (Category $category) {
            return $category->toObject();
        }, $categories);
    }

    public function getById(Request $request, string $id)
    {
        $category = $this->service->getById($id);

        return $category?->toObject();
    }

    public function create(Request $request)
    {
        $entity = new Category([
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? '',
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, string $id)
    {
        $entity = new Category([
            'id' => $id,
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? '',
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated?->toObject();
    }

    public function delete(Request $request, string $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }
}
