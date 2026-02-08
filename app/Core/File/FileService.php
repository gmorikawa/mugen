<?php

namespace App\Core\File;

use App\Core\File\Exceptions\FileNotFoundException;
use App\Core\File\Interfaces\FileRepository;
use App\Core\File\Interfaces\Storage;

class FileService
{
    function __construct(
        protected Storage $storage,
        protected FileRepository $repository,
    ) {}

    function getById(String $id)
    {
        $file = $this->repository->findById($id);

        if ($file === null) {
            throw new FileNotFoundException();
        }

        return $file;
    }

    function create(File $entity)
    {
        $entity = $this->repository->create($entity);

        return $entity;
    }

    function update(String $id, File $entity)
    {
        $file = $this->getById($id);

        if ($file === null) {
            throw new FileNotFoundException();
        }

        return $this->repository->update(
            $id,
            new File(
                name: $entity->name,
                path: $entity->path,
            )
        );
    }

    function upload(String $id, $stream)
    {
        $file = $this->getById($id);

        $success = $this->storage->write($file, $stream);

        if ($success) {
            return $this->changeState($id, FileState::AVAILABLE);
        } else {
            return $this->changeState($id, FileState::CORRUPTED);
        }
    }

    function download(String $id)
    {
        $file = $this->getById($id);

        $exists = $this->storage->exists($file);

        if ($exists) {
            return $this->storage->read($file);
        } else {
            $this->changeState($id, FileState::CORRUPTED);
            throw new FileNotFoundException();
        }
    }

    function remove(String $id)
    {
        $file = $this->getById($id);

        if ($this->storage->exists($file)) {
            $this->storage->delete($file);
        }

        return $this->repository->delete($id);
    }

    function changeState(String $id, FileState $state)
    {
        $entity = $this->repository->findById($id);

        if ($entity === null) {
            throw new FileNotFoundException();
        }

        return $this->repository->update(
            $id,
            new File(
                id: $entity->id,
                name: $entity->name,
                path: $entity->path,
                state: $state,
            )
        );
    }
}
