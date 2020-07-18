<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \Illuminate\Support\Str;

class HorizontalAdCard extends Component
{
    public $link, $image, $name, $description, $price, $lastUpdated, $actions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $image, $name, $description, $lastUpdated, $price=null, $actions=null)
    {

        $this->link = $link;
        $this->image = $image;
        $this->name = $name;
        $this->description = Str::limit($description, $limit = 120, $end = '...');
        $this->price = $price;
        $this->actions = $actions;
        $this->lastUpdated = date('d/m/Y H:i:s', strtotime($lastUpdated));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ads.horizontal-card');
    }
}
