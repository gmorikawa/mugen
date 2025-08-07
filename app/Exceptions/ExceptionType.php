<?php

namespace App\Exceptions;

enum ExceptionType: String {
    case BUSINESS = "BUSINESS";
    case APPLICATION = "APPLICATION";
}