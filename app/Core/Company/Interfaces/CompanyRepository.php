<?php

namespace App\Core\Company\Interfaces;

use App\Core\Company\Company;

interface CompanyRepository
{
    public function findAll(): array;
    public function findById(string $id): Company | null;
    public function create(Company $colorEncoding): Company;
    public function update(string $id, Company $colorEncoding): Company | null;
    public function delete(string $id): bool;
}
