<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreateButton extends Component
{
    protected $route;
    protected $permission;

    /**
     * Create a new component instance.
     */
    public function __construct($route, $permission)
    {
        $this->route = $route;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.form-create-button');
    }
}
