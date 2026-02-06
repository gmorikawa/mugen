<?php

namespace App\Core\Auth\Exceptions;

use App\Shared\Exceptions\BusinessException;

class InvalidTokenException extends BusinessException
{
    protected $error_message = "Invalid or expired token provided";
}
