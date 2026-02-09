<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\Platform\Platform;
use App\Core\Platform\PlatformType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class PlatformModel extends Model
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
        return $this->belongsTo(CompanyModel::class, 'developer_id');
    }

    public function manufacturer(): BelongsTo {
        return $this->belongsTo(CompanyModel::class, 'manufacturer_id');
    }

    public function toObject(): Platform {
        return new Platform([
            'id' => $this->id,
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'type' => PlatformType::from($this->type),
            'developer' => $this->developer?->toObject() ?? null,
            'manufacturer' => $this->manufacturer?->toObject() ?? null
        ]);
    }
}
