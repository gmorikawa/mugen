<?php

namespace App\Core\ColorEncoding\Interfaces;

use App\Core\ColorEncoding\ColorEncoding;

interface ColorEncodingRepository
{
    public function findAll(): array;
    public function findById(string $id): ColorEncoding | null;
    public function create(ColorEncoding $colorEncoding): ColorEncoding;
    public function update(string $id, ColorEncoding $colorEncoding): ColorEncoding | null;
    public function delete(string $id): bool;
}
