<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    function getAll()
    {
        $service = new ImageService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new ImageService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new ImageService();
        $data = $this->extractDataFromRequest($request);
        $entity = new Image([
            'game_id' => $data['game_id'],
            'color_encoding_id' => $data['color_encoding_id'],
            'file_id' => $data['file_id'],
            'description' => $data['description'] ?? ''
        ]);

        return $service->create($entity, $data['languages'] ?? []);
    }

    function update(Request $request, String $id)
    {
        $service = new ImageService();
        $data = $this->extractDataFromRequest($request);

        $entity = new Image([
            'game_id' => $data['game_id'],
            'color_encoding_id' => $data['color_encoding_id'],
            'file_id' => $data['file_id'],
            'description' => $data['description'] ?? ''
        ]);

        return $service->update($id, $entity, $data['languages'] ?? []);
    }

    function remove(Request $request, String $id)
    {
        $service = new ImageService();

        return $service->remove($id);
    }

    private function extractDataFromRequest(Request $request)
    {
        return $request->validate([
            'game_id' => 'required|exists:games,id',
            'color_encoding_id' => 'required|exists:color_encodings,id',
            'file_id' => 'required|exists:files,id',
            'description' => 'nullable|string',
            'languages' => 'array',
            'languages.*' => 'exists:companies,id',
        ]);
    }
}
