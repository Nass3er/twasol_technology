<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClickIcon extends Component
{
    public string $icon;
    public string $url;
    public string $label;

    public function __construct(string $icon, string $url, string $label = '')
    {
        $this->icon = $icon;
        $this->url = $url;
        $this->label = $label;
    }


    public function render(): View|Closure|string
    {
        return view('components.click-icon');
    }
    
}
