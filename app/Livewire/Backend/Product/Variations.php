<?php

namespace App\Livewire\Backend\Product;

use App\Models\ProductVariation;
use App\Models\Color;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Variations extends Component
{
    use WithPagination, WithFileUploads;

    public $productId;
    public $color_id, $image, $currentImage, $variationId;

    protected $rules = [
        'color_id' => 'required|exists:colors,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function edit($id)
    {
        $variation = ProductVariation::findOrFail($id);
        $this->variationId = $variation->id;
        $this->color_id = $variation->color_id;
        $this->currentImage = $variation->image;
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image->store('variation_images', 'public');
        }

        ProductVariation::updateOrCreate(
            ['id' => $this->variationId],
            [
                'product_id' => $this->productId,
                'color_id' => $this->color_id,
                'image' => $this->image ? $imagePath : $this->currentImage,
            ]
        );

        $this->resetInputFields();
        session()->flash('message', $this->variationId ? 'Variation updated successfully.' : 'Variation added successfully.');
    }

    public function delete($id)
    {
        $variation = ProductVariation::findOrFail($id);
        $variation->delete();
        session()->flash('message', 'Variation deleted successfully.');
    }

    public function resetInputFields()
    {
        $this->variationId = null;
        $this->color_id = null;
        $this->image = null;
        $this->currentImage = null;
    }

    public function render()
    {
        $variations = ProductVariation::where('product_id', $this->productId)->paginate(5);
        $colors = Color::all();
        return view('livewire.backend.product.variations', compact('variations', 'colors'));
    }
}
