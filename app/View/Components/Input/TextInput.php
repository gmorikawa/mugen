<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public function __construct(
        public string $property,
        public string $value = '',
        public string $placeholder = '',
        public string $label = '',
        public array $errors = []
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.input.text-input');
    }
}
