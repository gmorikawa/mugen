<?php

namespace App\Core\Country;

use App\Core\Country\Interfaces\CountryRepository;
use App\Core\File\File;
use App\Core\File\FileService;
use App\Core\Country\Exceptions\CountryNotFoundException;

class CountryService
{
    public function __construct(
        protected CountryRepository $repository,
        protected FileService $fileService,
    ) {}

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function create(Country $entity)
    {
        return $this->repository->create($entity);
    }

    public function update(string $id, Country $entity)
    {
        $country = $this->repository->findById($id);

        if (!$country) {
            return null;
        }

        return $this->repository->update(
            $id,
            new Country([
                'id' => $id,
                'name' => $entity->name,
                'flag' => $entity->flag,
            ])
        );
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    public function retrieveFlag(String $id)
    {
        $country = $this->getById($id);

        if ($country->flag === null) {
            throw new CountryNotFoundException();
        }

        return $this->fileService->download($country->flag->id);
    }

    public function storeFlag(String $id, $flagStream): Country
    {
        $country = $this->getById($id);
        $fileExtension = $flagStream->getClientOriginalExtension();

        $flagFile = $this->fileService->create(
            File::fromArray([
                'name' => $country->id . '_' . $country->name . '.' . $fileExtension,
                'path' => 'flags/',
            ])
        );

        $this->fileService->upload($flagFile->id, $flagStream);

        $updatedCountry = new Country([
            'id' => $country->id,
            'name' => $country->name,
            'flag' => $flagFile,
        ]);

        return $this->repository->update($id, $updatedCountry);
    }
}
