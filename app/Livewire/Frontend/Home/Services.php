<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.services',[
            'services' => Service::all(),
        ]);
    }
}
