<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Platform extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'platforms';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'abbreviation',
        'type',
        'developer_id',
        'manufacturer_id'
    ];

    public function developer(): BelongsTo {
        return $this->belongsTo(Company::class, 'developer_id');
    }

    public function manufacturer(): BelongsTo {
        return $this->belongsTo(Company::class, 'manufacturer_id');
    }
}
