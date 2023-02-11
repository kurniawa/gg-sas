<?php

namespace App\View\Components\Item;

use Illuminate\View\Component;

class Codename extends Component
{
    public $antings;
    public $giwangs;
    public $cincins;
    public $kalungs;
    public $gelangrantais;
    public $gelangbulats;
    public $liontins;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($antings,$giwangs,$cincins,$kalungs,$gelangrantais,$gelangbulats,$liontins)
    {
        $this->antings=$antings;
        $this->giwangs=$giwangs;
        $this->cincins=$cincins;
        $this->kalungs=$kalungs;
        $this->gelangrantais=$gelangrantais;
        $this->gelangbulats=$gelangbulats;
        $this->liontins=$liontins;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.codename');
    }
}
