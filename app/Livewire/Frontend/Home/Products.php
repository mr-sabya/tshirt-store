<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $categoryId;
    public $categories = [];
    public $products = [];

    public function mount()
    {
        $this->categories = Category::all();

        if ($this->categories->isNotEmpty()) {
            $this->categoryId = $this->categories->first()->id;
            $this->loadProducts();
        }
    }

    public function getCategoryId($id)
    {
        $this->categoryId = $id;
        $this->loadProducts();

        // Force Livewire to re-render the component
        $this->dispatch('$refresh');
    }

    private function loadProducts()
    {
        // Clear the products before loading new ones
        $this->reset('products');

        if (!$this->categoryId) {
            $this->products = [];
            return;
        }

        $this->products = Product::where('is_stock', 1)
            ->where('status', 1)
            ->where('category_id', $this->categoryId)
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.home.products');
    }
}
