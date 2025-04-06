<?php

namespace App\Livewire\Backend\Promotion;

use App\Models\Product;
use App\Models\Promotion;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $promotion;
    public $product_name, $offer_text, $offer_image, $offer_description, $product_id, $background_image;
    public $offerImagePreview, $backgroundImagePreview;

    public function mount()
    {
        $this->promotion = Promotion::find(1); // Get the promotion with id = 1

        $this->product_name = $this->promotion->product_name;
        $this->offer_text = $this->promotion->offer_text;
        $this->offer_description = $this->promotion->offer_description;
        $this->product_id = $this->promotion->product_id;
        $this->offerImagePreview = asset('storage/' . $this->promotion->offer_image);
        $this->backgroundImagePreview = asset('storage/' . $this->promotion->background_image);
    }

    public function updatedOfferImage()
    {
        $this->offerImagePreview = $this->offer_image->temporaryUrl();
    }

    public function updatedBackgroundImage()
    {
        $this->backgroundImagePreview = $this->background_image->temporaryUrl();
    }

    public function updatePromotion()
    {
        $data = $this->validate([
            'product_name' => 'required|string|max:255',
            'offer_text' => 'required|string|max:255',
            'offer_image' => 'nullable|image|max:1024',
            'offer_description' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'background_image' => 'nullable|image|max:1024',
        ]);

        if ($this->offer_image) {
            $data['offer_image'] = $this->offer_image->store('promotions', 'public');
        } else {
            $data['offer_image'] = $this->promotion->offer_image;
        }

        if ($this->background_image) {
            $data['background_image'] = $this->background_image->store('promotions', 'public');
        } else {
            $data['background_image'] = $this->promotion->background_image;
        }

        $this->promotion->update($data);

        session()->flash('message', 'Promotion updated successfully.');
    }

    public function render()
    {
        return view('livewire.backend.promotion.index', [
            'products' => Product::all(),
        ]);
    }
}
