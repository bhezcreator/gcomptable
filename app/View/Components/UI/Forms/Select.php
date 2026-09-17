<?php

namespace App\View\Components\ui\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public array $options = [],
        public mixed $selected = null,
        public ?string $placeholder = 'Sélectionnez une option',
        public ?string $helper = null,
        public bool $required = false,
        public bool $multiple = false,
        public bool $disabled = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.forms.select');
    }
}
