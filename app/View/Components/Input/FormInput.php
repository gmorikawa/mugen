<?php

namespace App\View\Components\Input;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class FormInput extends Component
{
    public string $type = 'text';

    public function __construct(
        public string $property,
        public string $value = '',
        public string $placeholder = 'example@email.com',
        public string $label = '',
        public array $errors = []
    ) {}

    public function render(): View
    {
        return view('components.input.form-input');
    }
}
