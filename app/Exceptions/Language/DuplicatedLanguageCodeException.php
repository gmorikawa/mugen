<?php

namespace App\Exceptions\Language;

use App\Exceptions\BusinessException;

class DuplicatedLanguageCodeException extends BusinessException {
    protected $error_code = "ERR_LANG_001";

    protected $error_message = "This langugae ISO code has already been registered.";
}