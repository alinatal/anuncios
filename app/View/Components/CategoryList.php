<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryList extends Component
{
    public $categories;
    public $accordion;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $route, $accordion = false)
    {
        $this->categories = $categories;
        $this->accordion = $accordion;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.category.list');
    }
}
