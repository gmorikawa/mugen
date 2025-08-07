<?php

namespace App\Exceptions;

use App\Enums\ExceptionType;

abstract class BusinessException extends ServerException {
    public function __construct()
    {
        parent::__construct(ExceptionType::BUSINESS, $this->error_message);
    }
}