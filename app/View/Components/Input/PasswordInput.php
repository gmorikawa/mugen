<?php

namespace App\View\Components\Input;

class PasswordInput extends FormInput
{
    public string $type = 'password';

    public function __construct(
        public string $property,
        public string $value = '',
        public string $placeholder = '******',
        public string $label = '',
        public array $errors = []
    ) {}
}
