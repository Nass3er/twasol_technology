<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ManagementCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $image;
    public $name;
    public $work;

    public function __construct($id,$image, $name, $work)
    {    
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->work = $work;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.management-card');
    }
}
