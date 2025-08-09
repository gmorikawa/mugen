<?php

namespace App\Exceptions\Platform;

use App\Exceptions\BusinessException;

class DuplicatedPlatformAbbreviationException extends BusinessException {
    protected $error_code = "ERR_PLAT_001";

    protected $error_message = "This abbreviation has already been registered.";
}