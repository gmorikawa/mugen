<?php

namespace App\Core\File\Exceptions;

use App\Shared\Exceptions\BusinessException;

class FileNotFoundException extends BusinessException {
    protected $error_message = "File does not exists.";
}