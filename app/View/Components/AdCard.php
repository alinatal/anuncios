<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \Illuminate\Support\Str;

class AdCard extends Component
{
    public $link, $image, $name, $description, $price, $lastUpdated, $actions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $image, $name, $description, $lastUpdated, $type='horizontal', $price=null, $actions=null)
    {

        $this->link = $link;
        if(gettype($image) == "array"){
            if(count($image) > 0) $image = $image[0];
            else $image = null;
        }
        $this->image = $image;
        $this->name = $name;
        $pos = strpos($description, ' ', 240);
        $this->description = substr($description, 0, $pos);/*Str::limit($description, $limit = 240, $end = '...')*/;
        $this->price = $price;
        $this->actions = $actions;
        $this->lastUpdated = date('d/m/Y H:i:s', strtotime($lastUpdated));
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if($this->type == 'horizontal'){
            return view('components.ads.horizontal-card');
        }
        else if($this->type == 'vertical'){
            return view('components.ads.vertical-card');
        }
    }
}
