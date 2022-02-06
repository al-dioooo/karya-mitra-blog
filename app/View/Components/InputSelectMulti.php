<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelectMulti extends Component
{
    public $for;
    public $items;
    public $value;
    public $header;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for, $items, $value = null, $header = null)
    {
        $this->for = $for;
        $this->items = $items;
        $this->value = $value;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-select-multi');
    }
}
