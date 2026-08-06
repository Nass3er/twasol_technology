<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public $image, $title, $description, $specs, $downloadLink;

    public function __construct($image, $title, $description, $specs = [], $downloadLink = '#')
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->specs = $specs;
        $this->downloadLink = $downloadLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-details');
    }
}
