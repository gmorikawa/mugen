<?php

namespace App\Core\Category;

class Category
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $description;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? '';
        $this->name = $attributes['name'] ?? '';
        $this->description = $attributes['description'] ?? '';
    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
