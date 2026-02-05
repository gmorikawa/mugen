<?php

namespace App\Core\Auth\Exception;

use Exception;

class InvalidCredentialsException extends Exception
{
    function __construct()
    {
        parent::__construct("Invalid credentials provided");
    }
}
