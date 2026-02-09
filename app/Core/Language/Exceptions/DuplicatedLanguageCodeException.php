<?php

namespace App\Core\Language\Exceptions;

use App\Shared\Exceptions\BusinessException;

class DuplicatedLanguageCodeException extends BusinessException
{
    protected $error_message = "This language ISO code has already been registered.";
}
