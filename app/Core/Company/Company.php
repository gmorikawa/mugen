<?php

namespace App\Core\Company;

use App\Core\Country\Country;

class Company
{
    public readonly string $id;
    public readonly string $name;
    public readonly Country | null $country;
    public readonly string $description;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? '';
        $this->name = $attributes['name'] ?? '';
        $this->country = $attributes['country'] ?? null;
        $this->description = $attributes['description'] ?? '';
    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country?->toObject(),
            'description' => $this->description,
        ];
    }
}
