<?php

namespace App\Shared\Exceptions;

use Exception;
abstract class BusinessException extends Exception {
    protected $error_message = "A business exception has occurred.";

    public function __construct()
    {
        parent::__construct($this->error_message);
    }
}
