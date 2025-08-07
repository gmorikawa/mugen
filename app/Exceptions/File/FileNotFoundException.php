<?php

namespace App\Exceptions\File;

use App\Exceptions\BusinessException;

class FileNotFoundException extends BusinessException {
    protected $error_code = "ERR_FILE_001";

    protected $error_message = "File does not exists.";
}