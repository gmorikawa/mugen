<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\Company\Company;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class CompanyModel extends Model
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

    public function country(): BelongsTo {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }

    public function toObject(): Company {
        return new Company([
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country?->toObject() ?? null,
            'description' => $this->description
        ]);
    }
}
