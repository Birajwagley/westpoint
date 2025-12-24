<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectField extends Component
{
    protected $label, $data, $fieldName, $class, $id, $required, $loopValue;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $data, $fieldName, $class = null, $id = null, $required = false, $loopValue,)
    {
        $this->label = $label;
        $this->data = $data;
        $this->fieldName = $fieldName;
        $this->class = $class;
        $this->id = $id;
        $this->required = $required;
        $this->loopValue = $loopValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fields.select-field');
    }
}
