<?php

namespace App\Core\File\Interfaces;

use App\Core\File\File;

interface FileRepository
{
    function findAll(): array;
    function findById(String $id): File | null;
    function create(File $entity): File;
    function update(String $id, File $entity): File | null;
    function delete(String $id): bool;
}