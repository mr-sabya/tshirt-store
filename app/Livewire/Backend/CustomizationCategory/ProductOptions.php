<?php

namespace App\Livewire\Backend\CustomizationCategory;

use App\Models\ProductOption;
use Livewire\Component;

class ProductOptions extends Component
{
    public $categoryId;
    public $productOptions;
    public $material, $price;
    public $product_option_id;
    public $isEditing = false;
    public $deleteId;

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->productOptions = ProductOption::where('customization_category_id', $this->categoryId)->get();
    }

    public function save()
    {
        $this->validate([
            'material' => 'required|string',
            'price' => 'required|numeric',
        ]);

        ProductOption::create([
            'customization_category_id' => $this->categoryId,
            'material' => $this->material,
            'price' => $this->price,
        ]);

        session()->flash('success', 'Product option added successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $option = ProductOption::findOrFail($id);
        $this->product_option_id = $option->id;
        $this->material = $option->material;
        $this->price = $option->price;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'material' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $option = ProductOption::find($this->product_option_id);
        $option->update([
            'material' => $this->material,
            'price' => $this->price,
        ]);

        session()->flash('success', 'Product option updated successfully!');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $option = ProductOption::findOrFail($this->deleteId);
        $option->delete();

        session()->flash('success', 'Product option deleted successfully!');
    }

    public function resetForm()
    {
        $this->material = '';
        $this->price = '';
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.backend.customization-category.product-options', [
            'productOptions' => $this->productOptions,
        ]);
    }
}
