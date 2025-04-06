<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Promotion;
use Livewire\Component;

class Offer extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.offer',[
            'offer' => Promotion::where('id', 1)->first(),
        ]);
    }
}
