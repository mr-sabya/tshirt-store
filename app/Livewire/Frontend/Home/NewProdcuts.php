<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;

class NewProdcuts extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.new-prodcuts',[
            'products' => Product::where('is_stock', 1)->where('status', 1)->orderBy('id', 'DESC')->take(4)->get(),
        ]);
    }
}
