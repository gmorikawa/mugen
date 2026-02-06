<?php

namespace App\Core\Auth\Interfaces;

use App\Core\Auth\Token;

interface TokenRepository {
    public function findByKey(string $key): Token;
    public function create(Token $token): Token;
    public function delete(string $key): bool;
}