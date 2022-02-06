<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputImage extends Component
{
    public $aspectW;
    public $aspectH;
    public $src;
    public $name;
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aspectW, $aspectH, $name, $id, $src = null)
    {
        $this->aspectW = $aspectW;
        $this->aspectH = $aspectH;
        $this->name = $name;
        $this->id = $id;
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-image');
    }
}
