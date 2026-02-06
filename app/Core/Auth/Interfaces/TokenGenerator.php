<?php

namespace App\Core\Auth\Interfaces;

use DateTime;

interface TokenGenerator
{
    function generate(string $domain, mixed $payload, DateTime $validUntil): string;
    function validate(string $domain, string $token): mixed;
    function revoke(string $token): bool;
}
