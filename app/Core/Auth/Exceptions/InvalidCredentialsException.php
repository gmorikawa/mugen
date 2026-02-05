<?php

namespace App\Core\Auth\Exceptions;

use App\Shared\Exceptions\BusinessException;

class InvalidCredentialsException extends BusinessException
{
    protected $error_message = "Invalid credentials provided";
}
