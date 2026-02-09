<?php

namespace App\Core\Platform\Exceptions;

use App\Exceptions\BusinessException;

class DuplicatedPlatformNameException extends BusinessException
{
    protected $error_message = "This name has already been registered.";
}
