<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ImageLanguage extends Pivot
{
    protected $table = 'image_language';
    public $timestamps = false;

    protected $fillable = [
        'image_id',
        'language_id',
    ];
}