<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    function getAll() {
        return Company::all();
    }

    function getById(Request $request, String $id) {
        return Company::where('id', $id)->get();
    }

    function create(Request $request) {
        $entity = $this->extractEntityFromRequest($request);

        $entity->save();

        return $entity;
    }

    function update(Request $request, String $id) {
        $entity = $this->extractEntityFromRequest($request);

        $country = Company::find($id);

        if ($country) {
            $country->name = $entity->name;
            $country->country_id = $entity->country_id;
            $country->description = $entity->description;
        }

        $country->save();

        return $country;
    }

    function remove(Request $request, String $id) {
        $count = Company::destroy($id);

        return $count > 0;
    }

    private function extractEntityFromRequest(Request $request) {
        return new Company([
            'name' => $request->input('name'),
            'country_id' => $request->input('country')['id'] ?? $request->input('country'),
            'description' => $request->input('description') ?? ''
        ]);
    }
}