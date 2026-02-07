<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Core\Auth\Interfaces\TokenRepository;
use App\Core\Auth\Token;
use App\Infrastructure\Persistence\Models\TokenModel;

class EloquentTokenRepository implements TokenRepository
{
    public function findByKey(string $key): Token | null
    {
        $found = TokenModel::where('key', $key)->first();

        return ($found !== null)
            ? Token::fromSerialized(
                domain: $found->domain,
                key: $found->key,
                payload: $found->payload,
                validUntil: $found->valid_until
            )
            : null;
    }

    public function create(Token $token): Token
    {
        $model = TokenModel::create([
            'domain' => $token->domain,
            'key' => $token->key,
            'payload' => $token->getSerializedPayload(),
            'valid_until' => $token->getSerializedValidUntil(),
        ]);

        return Token::fromSerialized(
            domain: $model->domain,
            key: $model->key,
            payload: $model->payload,
            validUntil: $model->valid_until
        );
    }

    public function delete(string $key): bool
    {
        $model = TokenModel::where('key', $key)->first();

        if (!$model) {
            return false;
        }

        $model->delete();
        return true;
    }
}
