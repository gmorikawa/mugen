<?php

namespace App\Core\Platform\Exceptions;

use App\Exceptions\BusinessException;

class DuplicatedPlatformAbbreviationException extends BusinessException
{
    protected $error_message = "This abbreviation has already been registered.";
}
