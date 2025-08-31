<?php

namespace App\Exceptions\User;

use App\Exceptions\BusinessException;

class DuplicatedUsernameException extends BusinessException {
    protected $error_code = "ERR_USER_001";

    protected $error_message = "This username has already been registered.";
}