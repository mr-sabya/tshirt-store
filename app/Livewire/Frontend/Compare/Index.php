<?php

namespace App\Livewire\Frontend\Compare;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $selectedProductId;
    public $compareProducts = [];

    public function mount()
    {
        $compare = session()->get('compare', []);
        $this->compareProducts = Product::whereIn('id', $compare)->get();
    }

    protected $listeners = ['compareUpdated' => 'refreshCompareList'];

    public function refreshCompareList()
    {
        $compare = session()->get('compare', []);
        $this->compareProducts = Product::whereIn('id', $compare)->get();
    }

    public function selectProduct($productId)
    {
        // Add product to compare list
        if (!in_array($productId, $this->compareList)) {
            $this->compareList[] = $productId;
            session()->put('compare', $this->compareList);  // Store in session for now
            $this->refreshCompareList();
        }
    }


    public function render()
    {
        return view('livewire.frontend.compare.index', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
