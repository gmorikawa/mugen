<?php

namespace App\Infrastructure\Persistence\Models;

use App\Core\Category\Category;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryModel extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'categories';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
    ];

    public function toObject(): Category {
        return new Category([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);
    }
}
