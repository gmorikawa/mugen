<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class UserProfileModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user_profiles';

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'fullname',
        'biography',
        'avatar_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function file(): BelongsTo {
        return $this->belongsTo(FileModel::class, 'avatar_id');
    }
}
