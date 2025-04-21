<?php

namespace App\Livewire\Backend\CustomizationCategory;

use App\Models\CustomizationCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $category_id, $name, $image, $newImage;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $deleteId;
    public $selectedCategory = null;
    public $selectedCategoryForVariation = null;

    protected $rules = [
        'name' => 'required|string|unique:customization_categories,name',
        'newImage' => 'required|image|max:2048',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->newImage
            ? $this->newImage->store('categories', 'public')
            : null;

        CustomizationCategory::create([
            'name' => $this->name,
            'image' => $imagePath,
        ]);

        $this->resetForm();
        session()->flash('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = CustomizationCategory::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->image = $category->image;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|unique:customization_categories,name,' . $this->category_id,
            'newImage' => 'nullable|image|max:2048',
        ]);

        $category = CustomizationCategory::findOrFail($this->category_id);

        $imagePath = $this->newImage
            ? $this->newImage->store('categories', 'public')
            : $category->image;

        $category->update([
            'name' => $this->name,
            'image' => $imagePath,
        ]);

        $this->resetForm();
        session()->flash('success', 'Category updated successfully!');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        CustomizationCategory::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        session()->flash('success', 'Category deleted.');
    }

    public function resetForm()
    {
        $this->reset(['name', 'image', 'newImage', 'isEditing', 'category_id']);
    }

    // show option
    public function showOptions($id)
    {
        $this->selectedCategoryForVariation = null;
        $this->selectedCategory = ($this->selectedCategory === $id) ? null : $id;
    }

    // showProductVariations
    public function showProductVariations($id)
    {
        $this->selectedCategory = null;
        $this->selectedCategoryForVariation = ($this->selectedCategoryForVariation === $id) ? null : $id;
    }

    public function render()
    {
        return view('livewire.backend.customization-category.index', [
            'categories' => CustomizationCategory::latest()->get(),
        ]);
    }
}
