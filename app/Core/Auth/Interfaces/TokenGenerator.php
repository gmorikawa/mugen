<?php

namespace App\Core\Auth\Interfaces;

use DateTime;

interface TokenGenerator
{
    function generate(string $domain, array $payload, DateTime $validUntil): string;
    function validate(string $domain, string $token): array;
}
