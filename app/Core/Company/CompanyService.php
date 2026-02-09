<?php

namespace App\Core\Company;

use App\Core\Company\Interfaces\CompanyRepository;

class CompanyService
{
    public function __construct(
        private CompanyRepository $repository
    ) { }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function create(Company $entity)
    {
        return $this->repository->create($entity);
    }

    public function update(string $id, Company $entity)
    {
        $company = $this->repository->findById($id);

        if (!$company) {
            return null;
        }

        return $this->repository->update(
            $id,
            new Company([
                'id' => $id,
                'name' => $entity->name,
                'country' => $entity->country,
                'description' => $entity->description,
            ])
        );
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }
}
