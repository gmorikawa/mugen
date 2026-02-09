<?php

namespace App\Core\Language\Interfaces;

use App\Core\Language\Language;

interface LanguageRepository
{
    public function findAll(): array;
    public function findById(string $id): Language | null;
    public function findByIsoCode(string $iso_code): Language | null;
    public function create(Language $language): Language;
    public function update(string $id, Language $language): Language | null;
    public function delete(string $id): bool;
}
