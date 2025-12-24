<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiFileUploadField extends Component
{
    protected $label, $data, $fieldName, $currentName, $class, $id, $required, $accept, $routeName;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $data, $fieldName, $currentName, $class = null, $id = null, $required = false, $accept, $routeName)
    {
        $this->label = $label;
        $this->data = $data;
        $this->fieldName = $fieldName;
        $this->currentName = $currentName;
        $this->class = $class;
        $this->id = $id;
        $this->required = $required;
        $this->accept = $accept;
        $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fields.multi-file-upload-field');
    }
}
