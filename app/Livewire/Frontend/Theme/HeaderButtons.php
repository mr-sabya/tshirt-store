<?php

namespace App\Livewire\Frontend\Theme;

use Livewire\Component;

class HeaderButtons extends Component
{
    public $isMobile = false;

    public function mouunt($isMobile = null)
    {
        if ($isMobile) {
            $this->isMobile = true;
        } else {
            $this->isMobile = false;
        }
    }
    
    public function render()
    {
        return view('livewire.frontend.theme.header-buttons');
    }
}
