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
            ? $found->toObject()
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

        return $model->toObject();
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
