<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\Language\Language;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LanguageModel extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'languages';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'iso_code'
    ];

    public function toObject(): Language {
        return new Language([
            'id' => $this->id,
            'name' => $this->name,
            'isoCode' => $this->iso_code
        ]);
    }
}
