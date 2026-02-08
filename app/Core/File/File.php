<?php

namespace App\Core\File;

use App\Shared\Entity\Entity;

class File extends Entity
{
    public readonly ?string $id;
    public readonly string $name;
    public readonly string $path;
    public readonly FileState $state;

    public function __construct(
        ?string $id = null,
        string $name,
        string $path,
        ?FileState $state = null,
    )
    {
        $this->id = $id ?? null;
        $this->name = $name;
        $this->path = $path;
        $this->state = $state ?? FileState::PENDING;
    }

    public static function fromArray(array $data): File
    {
        return new File(
            $data['id'] ?? null,
            $data['name'],
            $data['path'],
            isset($data['state']) ? FileState::from($data['state']) : null,
        );
    }

    public function toObject(): array
    {
        $object =  [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->path,
            'state' => $this->state->value,
        ];

        return $object;
    }
}
