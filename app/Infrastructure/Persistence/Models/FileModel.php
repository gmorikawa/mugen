<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\File\File;
use App\Core\File\FileState;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FileModel extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'files';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'path',
        'state'
    ];

    public function getFilePathAttribute(): string
    {
        if (str_ends_with($this->path, '/')) {
            return substr($this->path, 1) . $this->name;
        } else {
            return substr($this->path, 1) . '/' . $this->name;
        }
    }

    public function toObject(): File
    {
        return new File(
            id: $this->id,
            name: $this->name,
            path: $this->path,
            state: FileState::from($this->state),
        );
    }
}
