<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DeleteButton extends Component
{
    protected $url, $class;

    /**
     * Create a new component instance.
     */
    public function __construct($url, $class)
    {
        $this->url = $url;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.delete-button');
    }
}
