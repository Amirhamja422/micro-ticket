<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class SelectComponent extends Component
{
    public $inputColClass;
    public $inputLabel;
    public $inputId;
    public $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputColClass, $inputLabel, $inputId, $required = '')
    {
        $this->inputColClass = $inputColClass;
        $this->inputLabel = $inputLabel;
        $this->inputId = $inputId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets.select-component');
    }
}
