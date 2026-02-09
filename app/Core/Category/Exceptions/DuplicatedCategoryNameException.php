<?php

namespace App\Core\Category\Exceptions;

use App\Exceptions\BusinessException;

class DuplicatedCategoryNameException extends BusinessException
{
    protected $error_message = "This name has already been registered.";
}
