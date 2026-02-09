<?php

namespace App\Application\Controller\API;

use App\Core\ColorEncoding\ColorEncoding;
use App\Core\ColorEncoding\ColorEncodingService;
use Illuminate\Http\Request;

class ColorEncodingController extends APIController
{
    public function __construct(
        protected ColorEncodingService $service
    ) {}

    public function getAll()
    {
        $colorEncodings = $this->service->getAll();

        return array_map(function (ColorEncoding $colorEncoding) {
            return $colorEncoding->toObject();
        }, $colorEncodings);
    }

    public function getById(Request $request, string $id)
    {
        $colorEncoding = $this->service->getById($id);

        return $colorEncoding?->toObject();
    }

    public function create(Request $request)
    {
        $entity = new ColorEncoding([
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? ''
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, string $id)
    {
        $entity = new ColorEncoding([
            'id' => $id,
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? ''
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated?->toObject();
    }

    public function delete(Request $request, string $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }
}
