<?php

namespace App\View\Components\Form\Layout;

use Illuminate\View\Component;

class Section extends Component
{
    public $submit;
    public $method;
    public $title;
    public $description;
    public $encoding;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($submit, $method, $title, $description = null, $encoding = null)
    {
        $this->submit = $submit;
        $this->method = $method;
        $this->title = $title;
        $this->description = $description;
        $this->encoding = $encoding;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.layout.section');
    }
}
