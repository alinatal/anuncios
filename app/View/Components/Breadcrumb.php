<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $home, $breadcrumbs, $postname;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($breadcrumbs, $postname, $home='/')
    {
        $this->home = $home;
        $this->breadcrumbs = $breadcrumbs;
        $this->postname = $postname;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
