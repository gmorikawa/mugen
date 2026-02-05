<?php

namespace App\Core\User;

class LoggedUser
{
    private ?string $id;
    private string $username;
    private string $email;
    private UserRole $role;

    private ?UserProfile $profile = null;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'];
        $this->email = $data['email'];
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

    public function getRole(): UserRole
    {
        return $this->role;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }
}
