<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderButtons extends Component
{
    public $isMobile = false;

    public function mount($isMobile = null)
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
