<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $selectedProductId = null;
    public $selectedProductIdForImages = null;
    public $selectedProductIdForSizes = null;

    public function toggleSort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleVariations($productId)
    {
        $this->selectedProductId = $this->selectedProductId === $productId ? null : $productId;
        $this->selectedProductIdForImages = null;
        $this->selectedProductIdForSizes = null;
    }

    public function toggleImages($productId)
    {
        $this->selectedProductIdForImages = $this->selectedProductIdForImages === $productId ? null : $productId;
        $this->selectedProductId = null;
        $this->selectedProductIdForSizes = null;
    }

    public function toggleforSizes($productId)
    {
        // Ensure selectedProductIdForSizes is set to null first
        $this->selectedProductIdForSizes = ($this->selectedProductIdForSizes === $productId) ? null : $productId;

        // dd($this->selectedProductIdForSizes);
        // Reset other variables to avoid conflicts
        $this->selectedProductId = null;
        $this->selectedProductIdForImages = null;
    }


    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.product.index', compact('products'));
    }
}
