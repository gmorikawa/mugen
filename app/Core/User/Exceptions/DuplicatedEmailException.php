<?php

namespace App\Core\User\Exceptions;

use App\Shared\Exceptions\BusinessException;

class DuplicatedEmailException extends BusinessException {
    protected $error_message = "This email has already been registered.";
}
