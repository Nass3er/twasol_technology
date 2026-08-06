<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IsoCarousel extends Component
{
    /**
     * Create a new component instance.
     */
    public $posts;
    public $style;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $posts, $style = "")
    {
        $this->posts= $posts;
        $this->style = $style;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.iso-carousel');
    }
}
