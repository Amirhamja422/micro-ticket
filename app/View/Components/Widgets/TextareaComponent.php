<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class TextareaComponent extends Component
{

    public $inputColClass;
    public $inputLabel;
    public $inputId;
    public $required;
    public $textareaVal;
    public $textRows;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputColClass, $inputLabel, $inputId, $required = '', $textareaVal = '', $textRows = '')
    {
        $this->inputColClass = $inputColClass;
        $this->inputLabel = $inputLabel;
        $this->inputId = $inputId;
        $this->required = $required;
        $this->textareaVal = $textareaVal;
        $this->textRows = $textRows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets.textarea-component');
    }
}
