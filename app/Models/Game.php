<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'release_date'
    ];

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
