<?php

namespace App\View\Components\Item;

use Illuminate\View\Component;

class Cap extends Component
{
    public $caps;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($caps)
    {
        $this->caps=$caps;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.cap');
    }
}
