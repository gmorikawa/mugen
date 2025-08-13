<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getAll()
    {
        $service = new CategoryService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new CategoryService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new CategoryService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new CategoryService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new CategoryService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new Category([
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? ''
        ]);
    }
}
