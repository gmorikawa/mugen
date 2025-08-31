<?php

namespace App\View\Components\Menu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component
{
    public function __construct(
        public string $title
    ) {}

    public function render(): View
    {
        return view('components.menu.section');
    }
}
