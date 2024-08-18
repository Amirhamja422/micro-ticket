<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class InputComponent extends Component
{
    public $inputColClass;
    public $inputLabel;
    public $inputId;
    public $inputType;
    public $required;
    public $inputVal;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputColClass, $inputLabel, $inputId, $inputType, $inputVal = '', $required = '', $placeholder='')
    {
        $this->inputColClass = $inputColClass;
        $this->inputLabel = $inputLabel;
        $this->inputId = $inputId;
        $this->inputType = $inputType;
        $this->inputVal = $inputVal;
        $this->required = $required;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets.input-component');
    }
}
