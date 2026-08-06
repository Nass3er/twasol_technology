<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $description, $icon;

    public function __construct($title, $description, $icon)
    {
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon-card');
    }
}
