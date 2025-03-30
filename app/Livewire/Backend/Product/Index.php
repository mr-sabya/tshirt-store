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
    public $selectedProductIdForInfo = null;
    public $selectedProductIdForSeo = null;

    public $productToDelete = null; // Store the product ID for deletion

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
        $this->selectedProductIdForInfo = null;
    }

    public function toggleImages($productId)
    {
        $this->selectedProductIdForImages = $this->selectedProductIdForImages === $productId ? null : $productId;
        $this->selectedProductId = null;
        $this->selectedProductIdForSizes = null;
        $this->selectedProductIdForInfo = null;
        $this->selectedProductIdForSeo = null;
    }

    public function toggleforSizes($productId)
    {
        // Ensure selectedProductIdForSizes is set to null first
        $this->selectedProductIdForSizes = ($this->selectedProductIdForSizes === $productId) ? null : $productId;

        // dd($this->selectedProductIdForSizes);
        // Reset other variables to avoid conflicts
        $this->selectedProductId = null;
        $this->selectedProductIdForImages = null;
        $this->selectedProductIdForInfo = null;
        $this->selectedProductIdForSeo = null;
    }

    public function toggleforInfo($productId)
    {
        // Ensure selectedProductIdForSizes is set to null first
        $this->selectedProductIdForInfo = ($this->selectedProductIdForInfo === $productId) ? null : $productId;

        // dd($this->selectedProductIdForSizes);
        // Reset other variables to avoid conflicts
        $this->selectedProductId = null;
        $this->selectedProductIdForImages = null;
        $this->selectedProductIdForSizes = null;
        $this->selectedProductIdForSeo = null;
    }


    public function toggleforSeo($productId)
    {
        // Ensure selectedProductIdForSizes is set to null first
        $this->selectedProductIdForSeo = ($this->selectedProductIdForSeo === $productId) ? null : $productId;

        // dd($this->selectedProductIdForSizes);
        // Reset other variables to avoid conflicts
        $this->selectedProductId = null;
        $this->selectedProductIdForImages = null;
        $this->selectedProductIdForSizes = null;
        $this->selectedProductIdForInfo = null;
    }


    public function confirmDelete($productId)
    {
        $this->productToDelete = $productId; // Set product to be deleted
    }

    public function deleteProduct()
    {
        if ($this->productToDelete) {
            Product::find($this->productToDelete)->delete();
            session()->flash('message', 'Product deleted successfully.');
            $this->productToDelete = null; // Reset
        }
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.product.index', compact('products'));
    }
}
