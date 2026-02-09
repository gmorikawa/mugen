<?php

namespace App\Core\User\Exceptions;

use App\Shared\Exceptions\BusinessException;

class ForbiddenAdminRemovalException extends BusinessException
{
    protected $error_message = "Admin user cannot be deleted.";
}
