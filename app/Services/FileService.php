<?php

namespace App\Services;

use App\Enums\FileState;
use App\Models\File;

use Illuminate\Support\Facades\Storage;

class FileService {
    function getAll() {
        return File::all();
    }

    function getById(String $id) {
        return File::find($id);
    }

    function create(File $entity) {
        $entity->state = FileState::PENDING->value;

        $entity->save();

        return $entity;
    }

    function update(String $id, File $entity) {
        $file = $this->getById($id);

        if ($file) {
            $file->name = $entity->name;
            $file->path = $entity->path;
        }

        $file->save();

        return $file;
    }

    function upload(String $id, $stream) {
        $file = $this->getById($id);

        $success = Storage::disk('local')
            ->putFileAs($file->path, $stream, $file->name);

        if ($success) {
            return $this->changeState($id, FileState::AVAILABLE);
        } else {
            return $this->changeState($id, FileState::CORRUPTED);
        }
    }

    function remove(String $id) {
        $removedEntities = File::destroy($id);

        if ($removedEntities > 0) {
            // remove file from storage
        }

        return $removedEntities;
    }

    function changeState(String $id, FileState $state) {
        return File::where('id', $id)
            ->update([ 'state' => $state->value ]);
    }
}