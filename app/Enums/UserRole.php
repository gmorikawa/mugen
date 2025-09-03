<?php

namespace App\Enums;

enum UserRole: String
{
    case ADMIN = 'ADMIN';
    case MANAGER = 'MANAGER';
    case MEMBER = 'MEMBER';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::MANAGER => 'Manager',
            self::MEMBER => 'Member',
        };
    }
}
