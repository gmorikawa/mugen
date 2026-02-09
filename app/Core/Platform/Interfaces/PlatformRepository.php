<?php

namespace App\Core\Platform\Interfaces;

use App\Core\Platform\Platform;

interface PlatformRepository
{
    public function findAll(): array;
    public function findByName(string $name): Platform | null;
    public function findByAbbreviation(string $abbreviation): Platform | null;
    public function findById(string $id): Platform | null;
    public function create(Platform $colorEncoding): Platform;
    public function update(string $id, Platform $colorEncoding): Platform | null;
    public function delete(string $id): bool;
}
