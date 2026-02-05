<?php

namespace App\Core\Auth;

class AdminSignup
{
    private string $email;
    private string $username;
    private string $password;

    public function __construct(string $email, string $username, string $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}