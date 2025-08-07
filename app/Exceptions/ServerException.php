<?php

namespace App\Exceptions;

use App\Enums\ExceptionType;
use Exception;

abstract class ServerException extends Exception {
    private $type = ExceptionType::BUSINESS;
    protected $error_code = '';
    protected $error_message = '';
    protected $http_status_code = 500;

    function __construct(ExceptionType $type, String $message)
    {
        $this->type = $type;
        
        parent::__construct($message);
    }

    /**
     * Retrives exception's type.
     *
     * @return ExceptionType Enum.
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Retrives exception's error code.
     *
     * @return String Custom error code.
     */
    public function getErrorCode() {
        return $this->error_code;
    }

    /**
     * Retrives custom error message.
     *
     * @return String Error message.
     */
    public function getErrorMessage() {
        return $this->error_message;
    }

    /**
     * Retrives response status code.
     *
     * @return int Response status code.
     */
    public function getHttpStatusCode() {
        return $this->http_status_code ?? 500;
    }
}