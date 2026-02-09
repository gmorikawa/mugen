<?php

namespace App\Core\Country\Interfaces;

use App\Core\Country\Country;

interface CountryRepository
{
    public function findAll(): array;
    public function findById(string $id): Country | null;
    public function create(Country $country): Country;
    public function update(string $id, Country $country): Country | null;
    public function delete(string $id): bool;
}