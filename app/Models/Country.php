<?php

namespace App\Models;

use App\Infrastructure\Persistence\Models\FileModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'countries';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'flag_id'
    ];

    public function flag(): BelongsTo {
        return $this->belongsTo(FileModel::class, 'flag_id');
    }
}
