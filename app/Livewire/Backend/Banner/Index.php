<?php

namespace App\Livewire\Backend\Banner;

use App\Helpers\ImageHelper;
use App\Models\Banner;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $heading, $offer_text, $text, $image, $imagePreview, $bannerId, $product_id, $existingImage;
    public $search = '';
    public $detailsBannerId = null; // Track the details view toggle
    public $sortBy = 'heading'; // Default sorting by 'heading'
    public $sortDirection = 'asc'; // Default sorting direction

    // Initial rules property declaration
    protected $rules = [
        'heading' => 'required|string|max:255',
        'offer_text' => 'required|string|max:255',
        'text' => 'required|string',
        'image' => 'nullable|image|max:1024', // Max 1MB for image
        'product_id' => 'required|exists:products,id', // Ensure the product exists
    ];

    // Handle image upload preview
    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    // Store or update the banner
    public function store()
    {
        // Dynamically update the validation rule for 'image' when updating a banner
        $this->rules['image'] = 'nullable|image|max:1024';

        // Validate input fields
        $this->validate();
        $imagePath = $this->image
            ? ImageHelper::uploadImage($this->image, 'banners', $this->existingImage)
            : $this->existingImage; // Retain the existing image if no new image

        // Store or update the banner
        Banner::updateOrCreate(
            ['id' => $this->bannerId],
            [
                'heading' => $this->heading,
                'offer_text' => $this->offer_text,
                'text' => $this->text,
                'image' => $imagePath,
                'product_id' => $this->product_id,
            ]
        );

        // Flash success message
        session()->flash('message', $this->bannerId ? 'Banner updated successfully.' : 'Banner created successfully.');

        // Reset form fields
        $this->resetInputFields();
    }

    // Load banner for editing
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $this->bannerId = $banner->id;
        $this->heading = $banner->heading;
        $this->offer_text = $banner->offer_text;
        $this->text = $banner->text;
        $this->product_id = $banner->product_id;
        $this->imagePreview = $banner->image ? asset('storage/' . $banner->image) : null;
        $this->existingImage = $banner->image;
    }

    // Delete a banner
    public function delete($id)
    {
        Banner::findOrFail($id)->delete();
        session()->flash('message', 'Banner deleted successfully.');
    }

    // Toggle details view
    public function toggleDetails($id)
    {
        $this->detailsBannerId = $this->detailsBannerId === $id ? null : $id;
    }

    // Toggle sorting direction and column
    public function toggleSort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->heading = '';
        $this->offer_text = '';
        $this->text = '';
        $this->image = null;
        $this->imagePreview = null;
        $this->product_id = null;
        $this->bannerId = null;
    }

    // Render the Livewire component
    public function render()
    {
        $banners = Banner::where('heading', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        $products = Product::all(); // Fetch all products for the dropdown

        return view('livewire.backend.banner.index', compact('banners', 'products'));
    }
}
