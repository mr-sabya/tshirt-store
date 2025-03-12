<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageGallery extends Component
{
    use WithFileUploads;

    public $product;
    public $images = [];
    public $newImagePreviews = [];

    protected $rules = [
        'images.*' => 'image|max:2048', // Limit: 2MB per image
    ];

    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
    }

    // Show preview when new images are selected
    public function updatedImages()
    {
        $this->newImagePreviews = [];

        foreach ($this->images as $image) {
            $this->newImagePreviews[] = $image->temporaryUrl();
        }
    }

    public function uploadImages()
    {
        $this->validate();

        foreach ($this->images as $image) {
            $path = $image->store('product_images', 'public');

            ProductImage::create([
                'product_id' => $this->product->id,
                'image_path' => $path,
            ]);
        }

        session()->flash('message', 'Images uploaded successfully.');

        // Clear previews
        $this->reset(['images', 'newImagePreviews']);
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        unlink(storage_path('app/public/' . $image->image_path));
        $image->delete();

        session()->flash('message', 'Image deleted successfully.');
    }

    public function render()
    {
        return view('livewire.backend.product.image-gallery', [
            'productImages' => $this->product->images,
        ]);
    }
}
