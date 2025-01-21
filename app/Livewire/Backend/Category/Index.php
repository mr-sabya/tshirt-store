<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $name, $slug, $image, $imagePreview, $categoryId;
    public $search = '';
    public $detailsCategoryId = null; // Track the details view toggle
    public $sortBy = 'name'; // Default sorting by 'name'
    public $sortDirection = 'asc'; // Default sorting direction

    // Initial rules property declaration
    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug',
        'image' => 'nullable|image|max:1024', // Max 1MB for image
    ];


    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);  // Auto-generate slug based on the name
    }

    // Handle image upload preview
    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    // Store or update the category
    public function store()
    {
        // Dynamically update the validation rule for 'slug' when updating a category
        $this->rules['slug'] = 'required|string|max:255|unique:categories,slug,' . ($this->categoryId ?? '0');
        
        // Validate input fields
        $this->validate();

        // Store or update the category
        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image ? $this->image->store('categories', 'public') : null,
            ]
        );

        // Flash success message
        session()->flash('message', $this->categoryId ? 'Category updated successfully.' : 'Category created successfully.');

        // Reset form fields
        $this->resetInputFields();
    }

    // Load category for editing
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->imagePreview = asset('storage/' . $category->image);
    }

    // Delete a category
    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    // Toggle details view
    public function toggleDetails($id)
    {
        $this->detailsCategoryId = $this->detailsCategoryId === $id ? null : $id;
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
        $this->name = '';
        $this->slug = '';
        $this->image = null;
        $this->imagePreview = null;
        $this->categoryId = null;
    }

    // Render the Livewire component
    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.category.index', compact('categories'));
    }

}
