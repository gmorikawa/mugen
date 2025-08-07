<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function flag(): HasOne {
        return $this->hasOne(File::class, 'flag_id');
    }
}
