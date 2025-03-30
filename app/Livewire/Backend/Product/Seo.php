<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Seo extends Component
{
    use WithFileUploads;

    public $product;
    public $meta_title, $meta_description, $meta_keywords;
    public $og_title, $og_description, $og_image;
    public $new_og_image;
    

    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
        $this->meta_title = $this->product->meta_title ?? $this->product->name;
        $this->meta_description = $this->product->meta_description ?? $this->product->short_desc;
        $this->meta_keywords = $this->product->meta_keywords;
        $this->og_title = $this->product->og_title ?? $this->product->name;
        $this->og_description = $this->product->og_description ?? $this->product->short_desc;
        $this->og_image = $this->product->og_image;
    }

    public function save()
    {
        $this->validate([
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
            'new_og_image' => 'nullable|image|max:2048', // Optional image validation
        ]);

        if ($this->new_og_image) {
            if ($this->og_image) {
                Storage::delete($this->og_image); // Delete old image
            }
            $this->og_image = $this->new_og_image->store('og_images', 'public');
        }

        $this->product->update([
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'og_image' => $this->og_image,
        ]);

        session()->flash('message', 'SEO & OG content updated successfully!');
    }
    
    public function render()
    {
        return view('livewire.backend.product.seo');
    }
}
