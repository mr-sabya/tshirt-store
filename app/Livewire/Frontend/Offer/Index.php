<?php

namespace App\Livewire\Frontend\Offer;

use App\Models\HotOffer;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.offer.index',[
            'offers' => HotOffer::with('product')->orderBy('id', 'DESC')->paginate(15),
        ]);
    }
}
