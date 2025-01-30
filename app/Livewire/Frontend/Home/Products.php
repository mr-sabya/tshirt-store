<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        $products = Product::where('is_stock', 1)->where('status', 1)->take(8)->get();
        return view('livewire.frontend.home.products',[
            'products' => $products,
        ]);
    }
}
