<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    function getAll()
    {
        $service = new CountryService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new CountryService();

        return $service->getbyId($id);
    }

    function create(Request $request)
    {
        $service = new CountryService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new CountryService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new CountryService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new Country([
            'name' => $request->input('name'),
            'flag_id' => $request->input('flag')['id'] ?? $request->input('flag'),
        ]);
    }
}
