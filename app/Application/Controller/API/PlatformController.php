<?php

namespace App\Application\Controller\API;

use App\Core\Platform\Platform;
use App\Core\Platform\PlatformService;
use App\Core\Platform\PlatformType;
use Illuminate\Http\Request;

class PlatformController extends APIController
{
    public function __construct(
        protected PlatformService $service
    ) {}

    public function getAll()
    {
        $platforms = $this->service->getAll();

        return array_map(function (Platform $platform) {
            return $platform->toObject();
        }, $platforms);
    }

    public function getById(Request $request, string $id)
    {
        $platform = $this->service->getById($id);

        return $platform->toObject();
    }

    public function create(Request $request)
    {
        $entity = new Platform([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'type' => $request->input('type')
                ? PlatformType::from($request->input('type'))
                : PlatformType::HOME,
            'developer' => $request->input('developer'),
            'manufacturer' => $request->input('manufacturer'),
            'description' => $request->input('description') ?? '',
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, string $id)
    {
        $entity = new Platform([
            'id' => $id,
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'type' => $request->input('type')
                ? PlatformType::from($request->input('type'))
                : PlatformType::HOME,
            'developer' => $request->input('developer'),
            'manufacturer' => $request->input('manufacturer'),
            'description' => $request->input('description') ?? '',
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated->toObject();
    }

    public function delete(Request $request, string $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }
}
