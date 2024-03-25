<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavbarMenu extends Component
{
    public $text;
    public $href;
    public $isActive;
    public function __construct($text, $href, $isActive = false)
    {
        $this->text = $text;
        $this->href = $href;
        $this->isActive = $isActive;
    }
    
        //
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar-menu');
    }
}
