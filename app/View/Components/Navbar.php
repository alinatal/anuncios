<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $email, $phone, $facebook, $twitter, $instagram, $logo, $logoUrl;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($email, $phone, $facebook, $twitter, $instagram, $logo, $logoUrl='/')
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
        $this->logo = $logo;
        $this->logoUrl = $logoUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
