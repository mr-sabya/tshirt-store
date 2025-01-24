<?php

namespace App\Livewire\Backend\Tshirt;

use App\Models\Tshirt;
use App\Models\TshirtCategory;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination;

    public $tshirt, $name, $slug, $image, $category_id, $is_active = 1, $tshirtId;
    public $search = '', $sortBy = 'id', $sortDirection = 'asc';
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|unique:tshirts,slug|max:255',
        'image' => 'required|image|max:2048', // Max 2MB image
        'category_id' => 'required|exists:tshirt_categories,id', // Ensure valid category
    ];


    // Auto-generate slug based on the name
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    // Save new tshirt
    public function save()
    {
        $validatedData = $this->validate();

        $imagePath = $this->image->store('tshirts', 'public'); // Store the image

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'tshirt_category_id' => $this->category_id,
            'image' => $imagePath,

        ];

        if ($this->is_active) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }

        Tshirt::create($data);

        session()->flash('message', 'Tshirt created successfully!');
        $this->resetForm();
    }

    // Edit existing tshirt
    public function edit($id)
    {
        $tshirt = Tshirt::findOrFail($id);
        $this->tshirt = $tshirt;
        $this->tshirtId = $tshirt->id;
        $this->name = $tshirt->name;
        $this->slug = $tshirt->slug;
        $this->category_id = $tshirt->category_id;
        // $this->image = $tshirt->image;

        if ($tshirt->is_active == 1) {
            $this->is_active = true;
        } else {
            $this->is_active = false;
        }

        $this->isEdit = true;
    }

    // Update tshirt
    public function update()
    {
        $validatedData = $this->validate();

        $tshirt = Tshirt::findOrFail($this->tshirtId);

        // If a new image is uploaded, update it
        if ($this->image) {
            $imagePath = $this->image->store('tshirts', 'public');
            $tshirt->image = $imagePath;
        }

        $tshirt->name = $this->name;
        $tshirt->slug = $this->slug;
        $tshirt->tshirt_category_id = $this->category_id;

        if ($this->is_active) {
            $tshirt->is_active = 1;
        } else {
            $tshirt->is_active = 0;
        }

        $tshirt->save();

        session()->flash('message', 'Tshirt updated successfully!');
        $this->resetForm();
    }

    // Delete tshirt
    public function delete($id)
    {
        Tshirt::findOrFail($id)->delete();
        session()->flash('message', 'Tshirt deleted successfully!');
    }

    // Reset form fields
    public function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->image = '';
        $this->category_id = '';
        $this->is_active = 1;
        $this->isEdit = false;
    }

    // Render method
    public function render()
    {
        $tshirts = Tshirt::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.tshirt.index', [
            'tshirts' => $tshirts,
            'categories' => TshirtCategory::all() // Passing categories for selection
        ]);
    }
}
