<?php

namespace App\View\Components\Button;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public function __construct(
        public string $action
    ) {}

    public function render(): View
    {
        return view('components.button.action-button');
    }
}
