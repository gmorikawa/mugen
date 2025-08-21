<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'images';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'game_id',
        'color_encoding_id',
        'file_id',
        'description'
    ];

    public function game(): BelongsTo {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function color_encoding(): BelongsTo {
        return $this->belongsTo(ColorEncoding::class, 'color_encoding_id');
    }

    public function file(): BelongsTo {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'image_language')
            ->using(ImageLanguage::class);
    }
}
