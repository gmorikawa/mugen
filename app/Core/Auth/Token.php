<?php

namespace App\Core\Auth;

use DateTime;

class Token
{
    public readonly string $domain;
    public readonly string $key;
    public readonly mixed $payload;
    public readonly DateTime $validUntil;

    public function __construct(
        string $domain,
        string $key,
        mixed $payload,
        DateTime $validUntil
    )
    {
        $this->domain = $domain;
        $this->key = $key;
        $this->payload = $payload;
        $this->validUntil = $validUntil;
    }

    public static function fromObject(
        string $domain,
        string $key,
        mixed $payload,
        DateTime $validUntil
    ): Token
    {
        return new Token(
            domain: $domain,
            key: $key,
            payload: $payload,
            validUntil: $validUntil
        );
    }

    public static function fromSerialized(
        string $domain,
        string $key,
        string $payload,
        string $validUntil
    ): Token
    {
        return new Token(
            domain: $domain,
            key: $key,
            payload: json_decode($payload),
            validUntil: new DateTime($validUntil)
        );
    }

    public function getSerializedPayload(): string
    {
        return json_encode($this->payload);
    }

    public function getSerializedValidUntil(): string
    {
        return $this->validUntil->format('Y-m-d H:i:s');
    }
}
