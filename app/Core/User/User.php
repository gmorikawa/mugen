<?php

namespace App\Core\User;

class User
{
    private ?string $id;
    private string $username;
    private string $email;
    private string $password;
    private UserRole $role;

    private ?UserProfile $profile = null;

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

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): UserRole
    {
        return $this->role;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }
}
