<?php

namespace App\View\Components\Input;

class TextInput extends FormInput
{
    public string $type = 'text';

    public function __construct(
        public string $property,
        public string $value = '',
        public string $placeholder = '',
        public string $label = '',
        public array $errors = []
    ) {}
}
