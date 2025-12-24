<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaField extends Component
{
    protected $label, $data, $fieldName, $class, $id;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $data, $fieldName, $class = null, $id = null)
    {
        $this->label = $label;
        $this->data = $data;
        $this->fieldName = $fieldName;
        $this->class = $class;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fields.textarea-field');
    }
}
