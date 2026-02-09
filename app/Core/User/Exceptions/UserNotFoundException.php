<?php

namespace App\Core\User\Exceptions;

use App\Shared\Exceptions\BusinessException;

class UserNotFoundException extends BusinessException
{
    protected $error_message = "User not found.";
}
