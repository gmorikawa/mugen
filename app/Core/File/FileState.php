<?php

namespace App\Core\File;

enum FileState: string
{
    case PENDING = 'PENDING';
    case UPLOADING = 'UPLOADING';
    case AVAILABLE = 'AVAILABLE';
    case CORRUPTED = 'CORRUPTED';
}