<?php

namespace App\Services;

use App\Enums\FileState;
use App\Exceptions\File\FileNotFoundException;
use App\Models\File;

class FileService
{
    function getAll()
    {
        return File::all();
    }

    function getById(String $id)
    {
        return File::find($id);
    }

    function create(File $entity)
    {
        $entity->state = FileState::PENDING->value;

        $entity->save();

        return $entity;
    }

    function update(String $id, File $entity)
    {
        $file = $this->getById($id);

        if ($file) {
            $file->name = $entity->name;
            $file->path = $entity->path;

            $file->save();
        }

        return $file;
    }

    function upload(String $id, $stream)
    {
        $storage = new StorageService();
        $file = $this->getById($id);

        $success = $storage->write($file, $stream);

        if ($success) {
            return $this->changeState($id, FileState::AVAILABLE);
        } else {
            return $this->changeState($id, FileState::CORRUPTED);
        }
    }

    function download(String $id)
    {
        $storage = new StorageService();
        $file = $this->getById($id);

        $exists = $storage->exists($file);

        if ($exists) {
            return $storage->read($file);
        } else {
            $this->changeState($id, FileState::CORRUPTED);
            throw new FileNotFoundException();
        }
    }

    function remove(String $id)
    {
        $storage = new StorageService();
        $file = $this->getById($id);

        if ($storage->exists($file)) {
            $storage->remove($file);
        }

        return File::destroy($id);
    }

    function changeState(String $id, FileState $state)
    {
        return File::where('id', $id)
            ->update(['state' => $state->value]);
    }
}
