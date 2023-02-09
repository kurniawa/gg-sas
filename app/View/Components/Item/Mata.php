<?php

namespace App\View\Components\Item;

use Illuminate\View\Component;

class Mata extends Component
{
    public $matas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($matas)
    {
        $this->matas=$matas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.mata');
    }
}
