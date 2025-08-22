<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    function getAll()
    {
        $service = new GameService();

        return $service->getAll();
    }

    function getById(Request $request, String $id)
    {
        $service = new GameService();

        return $service->getById($id);
    }

    function create(Request $request)
    {
        $service = new GameService();
        $data = $this->extractDataFromRequest($request);
        $entity = new Game([
            'title' => $data['title'],
            'platform_id' => $data['platform_id'],
            'cover_id' => $data['cover_id'] ?? null,
            'release_date' => $data['release_date'] ?? null
        ]);

        return $service->create($entity, $data['categories'] ?? [], $data['developers'] ?? [], $data['publishers'] ?? []);
    }

    function update(Request $request, String $id)
    {
        $service = new GameService();
        $data = $this->extractDataFromRequest($request);

        $entity = new Game([
            'title' => $data['title'],
            'platform_id' => $data['platform_id'],
            'cover_id' => $data['cover_id'] ?? null,
            'release_date' => $data['release_date'] ?? null
        ]);

        return $service->update($id, $entity, $data['categories'] ?? [], $data['developers'] ?? [], $data['publishers'] ?? []);
    }

    function remove(Request $request, String $id)
    {
        $service = new GameService();

        return $service->remove($id);
    }

    private function extractDataFromRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
            'release_date' => 'nullable|date',
            'platform_id' => 'required|exists:platforms,id',
            'cover_id' => 'nullable|exists:files,id',
            'developers' => 'array',
            'developers.*' => 'exists:companies,id',
            'publishers' => 'array',
            'publishers.*' => 'exists:companies,id',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);
    }
}
