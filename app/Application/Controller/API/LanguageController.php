<?php

namespace App\Application\Controller\API;

use App\Core\Language\Language;
use App\Core\Language\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends APIController
{
    public function __construct(
        protected LanguageService $service
    ) { }

    function getAll()
    {
        $languages = $this->service->getAll();

        return array_map(function ($language) {
            return $language->toObject();
        }, $languages);
    }

    function getById(Request $request, String $id)
    {
        $language = $this->service->getById($id);

        return $language->toObject();
    }

    function create(Request $request)
    {
        $entity = new Language([
            'name' => $request->input('name'),
            'isoCode' => $request->input('isoCode') ?? '',
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    function update(Request $request, String $id)
    {
        $entity = new Language([
            'id' => $id,
            'name' => $request->input('name'),
            'isoCode' => $request->input('isoCode') ?? '',
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated->toObject();
    }

    function delete(Request $request, String $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }
}
