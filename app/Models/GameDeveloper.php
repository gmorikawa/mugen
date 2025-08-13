<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GameDeveloper extends Pivot
{
    protected $table = 'game_developer';
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'company_id',
    ];
}