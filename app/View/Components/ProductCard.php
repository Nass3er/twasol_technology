<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $image;
    public $name;
    public $detailsUrl;

    public function __construct($id,$image, $name, $detailsUrl)
    {    
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->detailsUrl = $detailsUrl;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
