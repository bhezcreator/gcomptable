<?php

namespace App\View\Components\ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public string $icon;

    public string $title;

    public string $description;

    public function __construct(
        string $title = 'Aucune donnée disponible',
        string $description = '',
        string $icon = 'las la-folder-open'
    ) {

        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.empty-state');
    }
}
