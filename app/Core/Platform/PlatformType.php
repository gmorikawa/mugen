<?php

namespace App\Core\Platform;

enum PlatformType: String
{
    case HOME = 'HOME';
    case PORTABLE = 'PORTABLE';
    case HYBRID = 'HYBRID';
}
