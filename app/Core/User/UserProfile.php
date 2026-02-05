<?php

namespace App\Core\User;

use App\Shared\Entity\Entity;

class UserProfile extends Entity
{
    public readonly ?string $fullname;
    public readonly ?string $biography;
    public readonly ?string $avatar;

    public function __construct(array $data)
    {
        $this->fullname = $data['fullname'] ?? null;
        $this->biography = $data['biography'] ?? null;
        $this->avatar = $data['avatar'] ?? null;
    }

    function toObject(): array
    {
        return [
            'fullname' => $this->fullname,
            'biography' => $this->biography,
            'avatar' => $this->avatar,
        ];
    }
}
