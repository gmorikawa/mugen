<?php

namespace App\Core\ColorEncoding;

use App\Core\ColorEncoding\Interfaces\ColorEncodingRepository;

class ColorEncodingService
{
    public function __construct(
        private ColorEncodingRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function create(ColorEncoding $entity)
    {
        return $this->repository->create($entity);
    }

    public function update(string $id, ColorEncoding $entity)
    {
        $colorEncoding = $this->repository->findById($id);

        if (!$colorEncoding) {
            return null;
        }

        return $this->repository->update(
            $id,
            new ColorEncoding([
                'id' => $id,
                'name' => $entity->name,
                'description' => $entity->description,
            ])
        );
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }
}
