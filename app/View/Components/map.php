<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class map extends Component
{
    /**
     * Create a new component instance.
     */
    public $alt;
    public $image;
    public $link;

    public function __construct($alt,$image, $link)
    {    
        $this->alt = $alt;
        $this->image = $image;
        $this->link = $link;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.map');
    }
}
