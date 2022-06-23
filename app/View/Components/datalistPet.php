<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datalistPet extends Component
{
    /**
     * Create a new component instance.
     *
     */
    public $header;
    public $data;
    public $hide;

    public function __construct($header, $data, $hide) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datalistPet');
    }
}
