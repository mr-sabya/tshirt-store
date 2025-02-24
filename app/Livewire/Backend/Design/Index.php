<?php

namespace App\Livewire\Backend\Design;

use App\Helpers\ImageHelper;
use App\Models\Design;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination;

    public $name, $slug, $image, $isEdit = false, $designId, $currentImage;
    public $search = '', $sortBy = 'id', $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|unique:designs,slug|max:255',
        'image' => 'required|image|max:1024', // Max 1MB image
    ];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);  // Auto-generate slug based on the name
    }

    // Function to handle the CRUD operations
    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:designs,slug',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $this->image
            ? ImageHelper::uploadImage($this->image, 'designs', $this->currentImage)
            : $this->currentImage; // Retain the existing image if no new image

        Design::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Design created successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $design = Design::findOrFail($id);
        $this->designId = $design->id;
        $this->name = $design->name;
        $this->slug = $design->slug;
        $this->currentImage = $design->image;
        $this->isEdit = true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:designs,slug,' . $this->designId,
            'image' => 'nullable|image|max:2048',
        ]);

        $design = Design::find($this->designId);

        if ($this->image) {
            $imagePath = $this->image
                ? ImageHelper::uploadImage($this->image, 'designs', $this->currentImage)
                : $this->currentImage; // Retain the existing image if no new image
            $design->image = $imagePath;
        }

        $design->name = $this->name;
        $design->slug = $this->slug;
        $design->save();

        session()->flash('message', 'Design updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        Design::findOrFail($id)->delete();
        session()->flash('message', 'Design deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->image = '';
        $this->isEdit = false;
    }

    // Render method added at the bottom
    public function render()
    {
        $designs = Design::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.backend.design.index', [
            'designs' => $designs
        ]);
    }
}
