<?php

namespace App\Infrastructure\Security\Token;

use App\Core\Auth\Interfaces\TokenGenerator;
use App\Core\Auth\Interfaces\TokenRepository;
use App\Core\Auth\Token;
use DateTime;
use Illuminate\Support\Facades\Hash;

class BcryptTokenGenerator implements TokenGenerator
{
    public function __construct(
        private readonly TokenRepository $repository
    ) {}

    public function generate(string $domain, mixed $payload, DateTime $validUntil): string
    {
        $data = $domain . '|' . json_encode($payload) . '|' . ($validUntil->getTimestamp());
        $token = Hash::make($data);

        $this->repository->create(
            Token::fromObject(
                domain: $domain,
                key: $token,
                payload: $payload,
                validUntil: $validUntil
            )
        );

        return $token;
    }

    public function validate(string $domain, string $key): mixed
    {
        $record = $this->repository->findByKey($key);

        if (!$record) {
            return [];
        }

        if ($record->validUntil < new \DateTime()) {
            return [];
        }

        if ($record->domain !== $domain) {
            return [];
        }

        return $record->payload;
    }

    public function revoke(string $key): bool
    {
        return $this->repository->delete($key);
    }
}
