<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Services\PlatformService;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    function getAll()
    {
        $service = new PlatformService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new PlatformService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new PlatformService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new PlatformService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new PlatformService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new Platform([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'type' => $request->input('type'),
            'developer_id' => $request->input('developer')['id'] ?? $request->input('developer'),
            'manufacturer_id' => $request->input('manufacturer')['id'] ?? $request->input('manufacturer'),
        ]);
    }
}
