<?php

namespace App\Core\User\Exceptions;

use App\Shared\Exceptions\BusinessException;

class DuplicatedUsernameException extends BusinessException
{
    protected $error_message = "This username has already been registered.";
}
