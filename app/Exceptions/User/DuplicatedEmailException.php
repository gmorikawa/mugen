<?php

namespace App\Exceptions\User;

use App\Exceptions\BusinessException;

class DuplicatedEmailException extends BusinessException {
    protected $error_code = "ERR_USER_002";

    protected $error_message = "This email has already been registered.";
}