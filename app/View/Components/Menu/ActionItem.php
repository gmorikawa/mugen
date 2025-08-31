<?php

namespace App\View\Components\Menu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionItem extends Component
{
    public function __construct(
        public string $label,
        public string $action
    ) {}

    public function render(): View
    {
        return view('components.menu.action-item');
    }
}
