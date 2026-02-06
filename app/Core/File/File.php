<?php

namespace App\Core\File;

use App\Shared\Entity\Entity;

class File extends Entity
{
    public readonly ?string $id;
    public readonly string $name;
    public readonly string $path;
    public readonly FileState $state;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->path = $data['path'];
        $this->state = $data['state'];
    }

    function toObject(): array
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
