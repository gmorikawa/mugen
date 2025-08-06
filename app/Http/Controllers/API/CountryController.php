<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller {
    function getAll() {
        return Country::all();
    }

    function getById(Request $request, String $id) {
        return Country::where('id', $id)->get();
    }

    function create(Request $request) {
        $entity = $this->extractEntityFromRequest($request);

        $entity->save();

        return $entity;
    }

    function update(Request $request, String $id) {
        $entity = $this->extractEntityFromRequest($request);

        $country = Country::find($id);

        if ($country) {
            $country->name = $entity->name;
            $country->flag = $entity->flag;
        }

        $country->save();

        return $country;
    }

    function remove(Request $request, String $id) {
        $count = Country::destroy($id);

        return $count > 0;
    }

    private function extractEntityFromRequest(Request $request) {
        return new Country([
            'name' => $request->input('name'),
            'flag' => $request->input('flag') ?? ''
        ]);
    }
}