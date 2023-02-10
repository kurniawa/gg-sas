<?php

namespace App\View\Components\Item;

use Illuminate\View\Component;

class Kondisi extends Component
{
    public $kondisis;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kondisis)
    {
        $this->kondisis=$kondisis;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.kondisi');
    }
}
