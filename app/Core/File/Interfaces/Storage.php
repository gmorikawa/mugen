<?php

namespace App\Core\File\Interfaces;

use App\Core\File\File;

interface Storage
{
    function exists(File $file): bool;
    function write(File $file, $stream): bool;
    function read(File $file): mixed;
    function delete(File $file): bool;
}