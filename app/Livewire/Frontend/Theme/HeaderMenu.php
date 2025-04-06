<?php

namespace App\Livewire\Frontend\Theme;

use Livewire\Component;

class HeaderMenu extends Component
{
    public $isMobile = false;
    public $compareCount = 0;

    protected $listeners = ['compareUpdated' => 'updateCompareCount'];

    public function mount($isMobile = null)
    {
        $this->isMobile = $isMobile ? true : false;
        $this->compareCount = count(session()->get('compare', []));
    }

    public function updateCompareCount()
    {
        $this->compareCount = count(session()->get('compare', []));
    }

    public function render()
    {
        return view('livewire.frontend.theme.header-menu');
    }
}
