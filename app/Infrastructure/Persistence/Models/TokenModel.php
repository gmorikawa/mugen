<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\Auth\Token;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TokenModel extends Model {
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'tokens';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'domain',
        'key',
        'payload',
        'valid_until'
    ];

    public function toObject(): Token {
        return Token::fromSerialized(
            domain: $this->domain,
            key: $this->key,
            payload: $this->payload,
            validUntil: $this->valid_until
        );
    }
}
