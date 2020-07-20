<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $images;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($images)
    {
        $this->images = $images;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if(gettype($this->images) == "array" && count($this->images) > 0){
            return view('components.carousel');
        }
    }
}
