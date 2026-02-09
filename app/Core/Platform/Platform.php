<?php

namespace App\Core\Platform;

use App\Core\Company\Company;

class Platform
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $abbreviation;
    public readonly PlatformType $type;
    public readonly Company | null $developer;
    public readonly Company | null $manufacturer;
    public readonly string $description;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? '';
        $this->name = $attributes['name'] ?? '';
        $this->abbreviation = $attributes['abbreviation'] ?? '';
        $this->type = $attributes['type'] ?? PlatformType::HOME;
        $this->developer = $attributes['developer'] ?? null;
        $this->manufacturer = $attributes['manufacturer'] ?? null;
        $this->description = $attributes['description'] ?? '';
    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'type' => $this->type->value,
            'developer' => $this->developer?->toObject(),
            'manufacturer' => $this->manufacturer?->toObject(),
            'description' => $this->description,
        ];
    }
}
