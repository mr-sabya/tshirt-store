<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Product;
use Livewire\Component;

class HeaderSearch extends Component
{
    public $query = '';  // Property to hold the search query
    public $products = [];  // Property to hold the search results

    // Method to update search results when query changes
    public function updatedQuery()
    {
        $this->products = Product::where('name', 'LIKE', "%{$this->query}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.theme.header-search');
    }
}
