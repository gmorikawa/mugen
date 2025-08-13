<?php

namespace App\Exceptions\Category;

use App\Exceptions\BusinessException;

class DuplicatedCategoryNameException extends BusinessException {
    protected $error_code = "ERR_CATE_001";

    protected $error_message = "This name has already been registered.";
}