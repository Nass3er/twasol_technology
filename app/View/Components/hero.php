<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hero extends Component
{
    /**
     * Create a new component instance.
     */
    
     public $title, $description, $img;

     public function __construct($title, $description, $img)
     {
         $this->title = $title;
         $this->description = $description;
         $this->img= $img;
     }
 

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero');
    }
}
