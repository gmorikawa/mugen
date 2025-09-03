<?php

namespace App\Exceptions\User;

use App\Exceptions\BusinessException;

class ForbiddenAdminRemovalException extends BusinessException {
    protected $error_code = "ERR_USER_003";

    protected $error_message = "Admin user cannot be deleted.";
}