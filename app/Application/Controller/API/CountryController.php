<?php

namespace App\Application\Controller\API;

use App\Core\Country\Country;
use App\Core\Country\CountryService;
use App\Core\File\File;
use Illuminate\Http\Request;

class CountryController extends APIController
{
    public function __construct(
        protected CountryService $service
    ) {}

    public function getAll()
    {
        $countries = $this->service->getAll();

        return array_map(function (Country $country) {
            return $country->toObject();
        }, $countries);
    }

    public function getById(Request $request, string $id)
    {
        $country = $this->service->getById($id);

        return $country
            ? $country->toObject()
            : null;
    }

    public function create(Request $request)
    {
        $entity = new Country([
            'name' => $request->input('name'),
            'flag' => $request->input('flag'),
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, string $id)
    {
        $entity = new Country([
            'id' => $id,
            'name' => $request->input('name'),
            'flag' => $request->input('flag'),
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated
            ? $updated->toObject()
            : null;
    }

    public function delete(Request $request, string $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }

    public function updateFlag(Request $request, string $id)
    {
        $flag = $request->file('flag');

        $this->service->storeFlag($id, $flag);
        return [
            'success' => true
        ];
    }

    public function downloadFlag(string $id)
    {
        return $this->service->retrieveFlag($id);
    }
}
