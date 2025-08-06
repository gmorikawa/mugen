<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class File extends Model {
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'files';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $incremening = false;

    protected $fillable = [
        'name',
        'concrete_name',
        'path',
        'size',
        'state'
    ];

    public function getFilePathAttribute(): string {
        if (str_ends_with($this->path, '/')) {
            return substr($this->path, 1) . $this->name;
        } else {
            return substr($this->path, 1) . '/' . $this->name;
        }
    }
}
