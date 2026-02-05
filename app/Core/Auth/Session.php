<?php

namespace App\Core\Auth;

use App\Core\User\LoggedUser;

class Session
{
    private string $token;
    private LoggedUser $loggedUser;

    public function __construct(string $token, LoggedUser $loggedUser)
    {
        $this->token = $token;
        $this->loggedUser = $loggedUser;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getLoggedUser(): LoggedUser
    {
        return $this->loggedUser;
    }
}