<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller {
    function getAll() {
        $service = new FileService();

        return $service->getAll();
    }

    function getById(Request $request, String $id) {
        $service = new FileService();

        return $service->getById($id);
    }

    function create(Request $request) {
        $service = new FileService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->create($entity);
    }

    function update(Request $request, String $id) {
        $service = new FileService();
        $entity = $this->extractEntityFromRequest($request);

        return $service->update($id, $entity);
    }

    function remove(Request $request, String $id) {
        $service = new FileService();

        return $service->remove($id);
    }

    function upload(Request $request, String $id) {
        $service = new FileService();

        $stream = $request->file('file');

        return $service->upload($id, $stream);
    }

    function download(Request $request, String $id) {
        $service = new FileService();

        return $service->download($id);
    }

    private function extractEntityFromRequest(Request $request) {
        return new File([
            'name' => $request->input('name'),
            'concrete_name' => $request->input('name'),
            'path' => $request->input('path'),
            'size' => 0,
        ]);
    }
}