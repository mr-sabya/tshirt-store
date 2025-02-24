<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class RelatedProducts extends Component
{
    public $categoryId;

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {
        $products = Product::where('is_stock', 1)
        ->where('category_id', $this->categoryId)
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->take(8)->get();
        
        return view('livewire.frontend.product.related-products', [
            'products' => $products,
        ]);
    }
}
