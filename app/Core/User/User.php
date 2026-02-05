<?php

namespace App\Core\User;

use App\Shared\Entity\Entity;

class User extends Entity
{
    public readonly ?string $id;
    public readonly string $username;
    public readonly string $email;
    public readonly string $password;
    public readonly UserRole $role;

    public readonly ?UserProfile $profile;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = isset($data['plain_password'])
            ? password_hash($data['plain_password'], PASSWORD_BCRYPT)
            : ($data['hashed_password'] ?? '');
        $this->role = $data['role'];
        $this->profile = $data['profile'] ?? null;
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    function toObject(): array
    {
        $object =  [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role->value,
            'profile' => $this->profile?->toObject(),
        ];

        return $object;
    }
}
