<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'companies';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'country_id',
        'description'
    ];

    public function country(): HasOne {
        return $this->hasOne(Country::class, 'country_id');
    }
}
