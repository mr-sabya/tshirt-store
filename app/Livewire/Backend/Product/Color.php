<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use Livewire\Component;

class Color extends Component
{
    public $product_id, $color_id, $is_stock = true, $stock = 0;
    public $productColors;

    protected $rules = [
        'product_id' => 'required',
        'color_id' => 'required',
        'stock' => 'required|integer|min:0',
    ];

    public function mount()
    {
        $this->productColors = Product::with('colors')->get();
    }

    public function store()
    {
        $this->validate();

        $product = Product::find($this->product_id);
        $product->colors()->attach($this->color_id, [
            'is_stock' => $this->is_stock,
            'stock' => $this->stock,
        ]);

        $this->resetFields();
        $this->mount();
    }

    public function resetFields()
    {
        $this->color_id = '';
        $this->is_stock = true;
        $this->stock = 0;
    }

    public function render()
    {
        return view('livewire.backend.product.color', [
            'products' => Product::all(),
            'colors' => Color::all(),
        ]);
    }

}
