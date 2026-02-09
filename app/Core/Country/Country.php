<?php

namespace App\Core\Country;

use App\Core\File\File;

class Country
{
    public readonly string $id;
    public readonly string $name;
    public readonly File | null $flag;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? '';
        $this->name = $attributes['name'] ?? '';
        $this->flag = $attributes['flag'] ?? null;
    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'flag' => $this->flag?->toObject(),
        ];
    }
}
