<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Divider extends Component
{
    public $color;
    public $size;
    public $margin;

    public function __construct($color = 'text-green-900', $size = 'text-2xl', $margin = 'm-10')
    {
        $this->color = $color;
        $this->size = $size;
        $this->margin = $margin;
    }

    public function render()
    {
        return view('components.divider');
    }
}
