<?php

namespace App\View\Components\ui\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(

        public ?string $name = null,

        public ?string $label = null,

        public mixed $value = 1,

        public bool $checked = false,

        public bool $disabled = false,

        public ?string $helper = null,

    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.forms.checkbox');
    }
}
