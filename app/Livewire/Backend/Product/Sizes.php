<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use App\Models\Size;
use Livewire\Component;

class Sizes extends Component
{
    public $product_id, $size_id, $is_stock = true, $stock = 0;
    public $updateMode = false; // Initialize the update mode

    protected $rules = [
        'size_id' => 'required',
        'stock' => 'required|integer|min:0',
    ];

    public function mount($productId)
    {
        $this->product_id = $productId;
    }

    public function store()
    {
        $this->validate();

        $product = Product::find($this->product_id);
        $product->sizes()->attach($this->size_id, [
            'is_stock' => $this->is_stock,
            'stock' => $this->stock,
        ]);

        $this->resetFields();
    }

    public function edit($sizeId)
    {
        $product = Product::find($this->product_id);
        $size = $product->sizes->find($sizeId);

        $this->size_id = $size->id;
        $this->is_stock = $size->pivot->is_stock;
        $this->stock = $size->pivot->stock;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::find($this->product_id);
        $product->sizes()->updateExistingPivot($this->size_id, [
            'is_stock' => $this->is_stock,
            'stock' => $this->stock,
        ]);

        $this->resetFields();
        $this->updateMode = false;
    }

    public function delete($sizeId)
    {
        $product = Product::find($this->product_id);
        $product->sizes()->detach($sizeId);
    }

    public function resetFields()
    {
        $this->size_id = '';
        $this->is_stock = true;
        $this->stock = 0;
        $this->updateMode = false;
    }

    // Add cancel method in the class
    public function cancel()
    {
        $this->resetFields();
        $this->updateMode = false;
    }


    public function render()
    {
        return view('livewire.backend.product.sizes', [
            'product' => Product::findOrFail($this->product_id),
            'sizes' => Size::all(),
        ]);
    }
}
