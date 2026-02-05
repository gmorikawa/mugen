<?php

namespace App\Shared\Entity;

abstract class Entity
{
    abstract function toObject(): array;
}
