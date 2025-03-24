<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use App\Models\ProductInfo;
use Livewire\Component;

class Info extends Component
{
    public $product_id, $key, $value, $productInfoId;
    public $productInfos = [];

    public function mount($productId)
    {
        $this->product_id = $productId;
        $this->loadProductInfos();
    }

    public function loadProductInfos()
    {
        $this->productInfos = ProductInfo::where('product_id', $this->product_id)
            ->with('product')
            ->latest()
            ->get();
    }

    public function save()
    {
        $this->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        if ($this->productInfoId) {
            // Update existing ProductInfo
            $info = ProductInfo::find($this->productInfoId);
            if ($info) {
                $info->update([
                    'key' => $this->key,
                    'value' => $this->value,
                ]);
                session()->flash('message', 'Product Info updated successfully.');
            }
        } else {
            // Create new ProductInfo
            ProductInfo::create([
                'product_id' => $this->product_id,
                'key' => $this->key,
                'value' => $this->value,
            ]);
            session()->flash('message', 'Product Info added successfully.');
        }

        $this->resetFields();
        $this->loadProductInfos();
    }

    public function edit($id)
    {
        $info = ProductInfo::find($id);
        if ($info) {
            $this->productInfoId = $info->id;
            $this->key = $info->key;
            $this->value = $info->value;
        }
    }

    public function delete($id)
    {
        ProductInfo::find($id)?->delete();
        $this->loadProductInfos();
        session()->flash('message', 'Product Info deleted.');
    }

    public function resetFields()
    {
        $this->productInfoId = null;
        $this->key = '';
        $this->value = '';
    }

    public function render()
    {
        $product = Product::find($this->product_id);
        return view('livewire.backend.product.info', compact('product'));
    }
}
