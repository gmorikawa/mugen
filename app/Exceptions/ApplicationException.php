<?php

namespace App\Exceptions;

use App\Enums\ExceptionType;
use Exception;

class ApplicationException extends ServerException {
    function __construct(Exception $ex, ?int $http_error_code)
    {
        $this->error_code = $ex->code;
        $this->error_message = $ex->message;
        $this->http_status_code = $http_error_code ?? 500;
        parent::__construct(ExceptionType::APPLICATION, $this->error_message);
    }
}