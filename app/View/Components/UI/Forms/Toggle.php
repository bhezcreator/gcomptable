<?php

namespace App\View\Components\ui\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toggle extends Component
{
    public function __construct(
        public string $label = '',
        public string $name = '',
        public bool $checked = false,
        public bool $disabled = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.forms.toggle');
    }
}
