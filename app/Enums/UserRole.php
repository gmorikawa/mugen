<?php

namespace App\Enums;

enum UserRole: String
{
    case ADMIN = 'ADMIN';
    case MANAGER = 'MANAGER';
    case MEMBER = 'MEMBER';
}
