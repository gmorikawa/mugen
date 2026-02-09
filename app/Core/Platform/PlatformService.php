<?php

namespace App\Core\Platform;

use App\Core\Platform\Exceptions\DuplicatedPlatformAbbreviationException;
use App\Core\Platform\Exceptions\DuplicatedPlatformNameException;
use App\Core\Platform\Interfaces\PlatformRepository;

class PlatformService
{
    public function __construct(
        private PlatformRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function create(Platform $entity)
    {
        if (!$this->isNameUnique($entity->name)) {
            throw new DuplicatedPlatformNameException();
        }

        if (!$this->isAbbreviationUnique($entity->abbreviation)) {
            throw new DuplicatedPlatformAbbreviationException();
        }

        return $this->repository->create($entity);
    }

    public function update(string $id, Platform $entity)
    {
        if (!$this->isNameUnique($entity->name, $id)) {
            throw new DuplicatedPlatformNameException();
        }

        if (!$this->isAbbreviationUnique($entity->abbreviation, $id)) {
            throw new DuplicatedPlatformAbbreviationException();
        }

        $platform = $this->repository->findById($id);

        if (!$platform) {
            return null;
        }

        return $this->repository->update(
            $id,
            new Platform([
                'id' => $id,
                'name' => $entity->name,
                'abbreviation' => $entity->abbreviation,
                'type' => $entity->type,
                'developer' => $entity->developer,
                'manufacturer' => $entity->manufacturer,
                'description' => $entity->description,
            ])
        );
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    private function isNameUnique(string $name, string $ignoreId = ''): bool
    {
        $platform = $this->repository->findByName($name);

        if ($platform && $platform->id !== $ignoreId) {
            return false;
        }

        return true;
    }

    private function isAbbreviationUnique(string $abbreviation, string $ignoreId = ''): bool
    {
        $platform = $this->repository->findByAbbreviation($abbreviation);

        if ($platform && $platform->id !== $ignoreId) {
            return false;
        }

        return true;
    }
}
