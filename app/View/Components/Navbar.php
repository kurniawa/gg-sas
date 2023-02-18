<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $goback;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($goback)
    {
        $this->goback=$goback;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
