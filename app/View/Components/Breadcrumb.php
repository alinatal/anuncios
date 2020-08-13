<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $home, $breadcrumbs, $postname, $slug, $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($breadcrumbs, $postname, $home='/', $slug=true, $route='category.show')
    {
        $this->home = $home;
        $this->breadcrumbs = $breadcrumbs;
        $this->postname = $postname;
        $this->slug = $slug;
        $this->route = $route;
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
