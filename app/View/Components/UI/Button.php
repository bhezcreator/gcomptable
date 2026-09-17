<?php

namespace App\View\Components\ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;

    public string $size;

    public function __construct(
        string $variant = 'primary',
        string $size = 'md'
    ) {
        $this->variant = $variant;
        $this->size = $size;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.button');
    }
}
