<?php

namespace App\Core\User\Interfaces;

use App\Core\User\User;

interface UserRepository
{
    function findAll(): array;
    function findById(string $id): User | null;
    function findByUsername(string $username): User | null;
    function findByEmail(string $email): User | null;
    function create(User $entity): User;
    function update(string $id, User $entity): User;
    function delete(string $id): bool;

    function generateToken(string $id): string;
    function confirmEmail(string $email): User;
}
