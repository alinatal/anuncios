<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListItem extends Component
{
    public $list, $bullet, $navbar;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($list, bool $bullet = false, bool $navbar = false)
    {
        if(gettype($list) == "string"){
            $list = json_decode($list);
            /*foreach ($list as $name => $link){
                if($link[0] == '/' && strlen($link)>1) $list->$name = substr($link, 1);
            }*/
        }
        $this->list = $list;
        $this->bullet = $bullet;
        $this->navbar = $navbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.list-item');
    }
}
