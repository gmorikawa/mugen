<?php

namespace App\Core\Language;

class Language
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $isoCode;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? '';
        $this->name = $attributes['name'] ?? '';
        $this->isoCode = $attributes['isoCode'] ?? '';
    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isoCode' => $this->isoCode,
        ];
    }
}
