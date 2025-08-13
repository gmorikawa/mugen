<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GamePublisher extends Pivot
{
    protected $table = 'game_publisher';
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'company_id',
    ];
}