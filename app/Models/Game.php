<?php

namespace App\Models;

use App\Infrastructure\Persistence\Models\FileModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Game extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'games';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'platform_id',
        'cover_id',
        'release_date'
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'datetime',
        ];
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    public function cover(): BelongsTo
    {
        return $this->belongsTo(FileModel::class, 'cover_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'game_category')
            ->using(GameCategory::class);
    }

    public function developers()
    {
        return $this->belongsToMany(Company::class, 'game_developer')
            ->using(GameDeveloper::class);
    }

    public function publishers()
    {
        return $this->belongsToMany(Company::class, 'game_publisher')
            ->using(GamePublisher::class);
    }
}
