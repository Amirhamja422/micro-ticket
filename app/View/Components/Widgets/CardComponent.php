<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class CardComponent extends Component
{
    public $cardTitle;
    public $btnVisible;
    public $btnName;
    public $btnClass;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardTitle, $btnVisible, $btnName, $btnClass)
    {
        $this->cardTitle = $cardTitle;
        $this->btnVisible = $btnVisible;
        $this->btnName = $btnName;
        $this->btnClass = $btnClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets.card-component');
    }
}
