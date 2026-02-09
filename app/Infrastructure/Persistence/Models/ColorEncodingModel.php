<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\ColorEncoding\ColorEncoding;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ColorEncodingModel extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'color_encodings';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description'
    ];

    public function toObject(): ColorEncoding {
        return new ColorEncoding([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
        ]);
    }
}
