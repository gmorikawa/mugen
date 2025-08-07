<?php

namespace App\Services;

use App\Models\Company;

class CompanyService {
    function getAll() {
        return Company::all();
    }

    function getById(String $id) {
        return Company::find($id);
    }

    function create(Company $entity) {
        $entity->save();

        return $entity;
    }

    function update(String $id, Company $entity) {
        $company = $this->getById($id);

        if ($company) {
            $company->name = $entity->name;
            $company->country_id = $entity->country_id;
            $company->description = $entity->description;
        }

        $company->save();

        return $company;
    }

    function remove(String $id) {
        return Company::destroy($id);
    }
}