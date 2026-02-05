<?php

namespace App\Core\User;

class UserProfile
{
    private ?string $fullname = null;
    private ?string $biography = null;
    private ?string $avatar = null;

    public function __construct(array $data)
    {
        $this->fullname = $data['fullname'] ?? null;
        $this->biography = $data['biography'] ?? null;
        $this->avatar = $data['avatar'] ?? null;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
}
