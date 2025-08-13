<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ColorEncoding;
use App\Services\ColorEncodingService;
use Illuminate\Http\Request;

class ColorEncodingController extends Controller
{
    function getAll()
    {
        $service = new ColorEncodingService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new ColorEncodingService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new ColorEncodingService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new ColorEncodingService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new ColorEncodingService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new ColorEncoding([
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? ''
        ]);
    }
}
