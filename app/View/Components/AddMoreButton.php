<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddMoreButton extends Component
{
    public string $wrapperId;
    public string $componentName;

    /**
     * Create a new component instance.
     *
     * @param string $wrapperId The ID of the wrapper where new fields will be added
     * @param string $componentName The name of the component/template to add
     */
    public function __construct(string $wrapperId, string $componentName)
    {
        $this->wrapperId = $wrapperId;
        $this->componentName = $componentName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.add-more-button');
    }
}
