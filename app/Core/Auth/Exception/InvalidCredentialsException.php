<?php

namespace App\Core\Auth\Exception;

use App\Shared\Exceptions\BusinessException;

class InvalidCredentialsException extends BusinessException
{
    function __construct()
    {
        parent::__construct("Invalid credentials provided");
    }
}
