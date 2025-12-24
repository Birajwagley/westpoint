<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusToggleButton extends Component
{
    protected $dataId, $status, $class;
    /**
     * Create a new component instance.
     */
    public function __construct($dataId, $status)
    {
        $this->dataId = $dataId;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.status-toggle-button');
    }
}
