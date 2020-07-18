<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $rightTitle, $rightText, $siteName, $siteLink, $facebook, $twitter, $instagram, $author, $authorLink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rightTitle, $rightText, $siteName, $siteLink='/', $facebook='#', $twitter='#', $instagram='#', $author = 'Cristian Cosano', $authorLink = 'https://cristiancosano.com/')
    {
        $this->rightTitle = $rightTitle;
        $this->rightText = $rightText;
        $this->siteName = $siteName;
        $this->siteLink = $siteLink;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
        $this->author = $author;
        $this->authorLink = $authorLink;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
