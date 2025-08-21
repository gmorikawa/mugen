<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function getAll()
    {
        $service = new CompanyService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new CompanyService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new CompanyService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new CompanyService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new CompanyService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new Company([
            'name' => $request->input('name'),
            'country_id' => $request->input('country')['id'] ?? $request->input('country') ?? $request->input('country_id'),
            'description' => $request->input('description') ?? ''
        ]);
    }
}
