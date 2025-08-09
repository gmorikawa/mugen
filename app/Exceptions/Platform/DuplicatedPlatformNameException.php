<?php

namespace App\Exceptions\Platform;

use App\Exceptions\BusinessException;

class DuplicatedPlatformNameException extends BusinessException {
    protected $error_code = "ERR_PLAT_002";

    protected $error_message = "This name has already been registered.";
}