<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function render()
    {
        $product = ModelsProduct::where('id', $this->productId)->first();
        return view('livewire.frontend.components.product',[
            'product' => $product,
        ]);
    }
}
