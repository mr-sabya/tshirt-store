<?php

namespace App\Livewire\Backend\ImageBanner;

use App\Helpers\ImageHelper;
use App\Models\ImageBanner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $title, $link, $alt_text, $image, $imagePreview, $imageBannerId, $existingImage;
    public $search = '';
    public $sortBy = 'title';
    public $sortDirection = 'asc';

    protected $rules = [
        'title' => 'required|string|max:255',
        'link' => 'nullable|url',
        'alt_text' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:1024', // Max 1MB
    ];

    // Image preview when updated
    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    // Store or update ImageBanner
    public function store()
    {
        $this->validate();

        $imagePath = $this->image
            ? ImageHelper::uploadImage($this->image, 'image_banners', $this->existingImage)
            : $this->existingImage;

        ImageBanner::updateOrCreate(
            ['id' => $this->imageBannerId],
            [
                'title' => $this->title,
                'link' => $this->link,
                'alt_text' => $this->alt_text,
                'image' => $imagePath,
            ]
        );

        session()->flash('message', $this->imageBannerId ? 'Image Banner updated successfully.' : 'Image Banner created successfully.');

        $this->resetInputFields();
        $this->resetErrorBag();
    }

    // Edit ImageBanner
    public function edit($id)
    {
        $imageBanner = ImageBanner::findOrFail($id);

        $this->imageBannerId = $imageBanner->id;
        $this->title = $imageBanner->title;
        $this->link = $imageBanner->link;
        $this->alt_text = $imageBanner->alt_text;
        $this->imagePreview = $imageBanner->image ? asset('storage/' . $imageBanner->image) : null;
        $this->existingImage = $imageBanner->image;
    }

    // Delete ImageBanner
    public function delete($id)
    {
        $imageBanner = ImageBanner::findOrFail($id);

        if ($imageBanner->image) {
            ImageHelper::deleteImage('public/' . $imageBanner->image);
        }

        $imageBanner->delete();

        session()->flash('message', 'Image Banner deleted successfully.');
    }

    // Search updated
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->title = '';
        $this->link = '';
        $this->alt_text = '';
        $this->image = null;
        $this->imagePreview = null;
        $this->imageBannerId = null;
        $this->existingImage = null;
    }

    public function render()
    {
        $imageBanners = ImageBanner::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.image-banner.index', compact('imageBanners'));
    }
}
