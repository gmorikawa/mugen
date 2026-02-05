<?php

namespace App\Core\User;

interface UserRepository
{
    function findAll(): array;
    function findById(String $id): User | null;
    function findByUsername(String $username): User | null;
    function findByEmail(String $email): User | null;
    function create(User $entity): User;
    function update(String $id, User $entity): User;
    function remove(String $id): bool;

    function generateToken(String $id): string;
}
