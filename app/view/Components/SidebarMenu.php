<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public $text;
    public $href;
    public $icon;
    public $isActive;

    public function __construct($icon, $text, $href, $isActive = false)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->href = $href;
        $this->isActive = $isActive;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-menu');
    }
}
