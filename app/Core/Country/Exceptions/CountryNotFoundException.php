<?php

namespace App\Core\Country\Exceptions;

use App\Shared\Exceptions\BusinessException;

class CountryNotFoundException extends BusinessException
{
    protected $error_message = "Country not found.";
}
