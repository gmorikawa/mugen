<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    function getAll()
    {
        $service = new LanguageService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new LanguageService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new LanguageService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id)
    {
        $service = new LanguageService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id)
    {
        $service = new LanguageService();

        return $service->remove($id);
    }

    private function extractEntityFromRequest(Request $request)
    {
        return new Language([
            'name' => $request->input('name'),
            'iso_code' => $request->input('iso_code') ?? '',
        ]);
    }
}
