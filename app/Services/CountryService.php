<?php

namespace App\Services;

use App\Models\Country;

class CountryService {
    function getAll() {
        return Country::all();
    }

    function getById(String $id) {
        return Country::find($id);
    }

    function create(Country $entity) {
        $entity->save();

        return $entity;
    }

    function update(String $id, Country $entity) {
        $country = $this->getById($id);

        if ($country) {
            $country->name = $entity->name;
            $country->flag = $entity->flag;
        }

        $country->save();

        return $country;
    }

    function remove(String $id) {
        return Country::destroy($id);
    }
}