<?php

namespace App\Livewire\Backend\CustomizationCategory;

use App\Models\CustomizationCategory;
use App\Models\CustomizationOption;
use Livewire\Component;
use Livewire\WithFileUploads;

class Options extends Component
{
    use WithFileUploads;

    public $category_id;
    public $option_id, $name, $price, $image, $newImage;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $deleteId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'nullable|numeric|min:0',
        'newImage' => 'nullable|image|max:2048',
    ];

    public function mount($categoryId)
    {
        $this->category_id = $categoryId;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->newImage ? $this->newImage->store('customization_options', 'public') : null;

        CustomizationOption::create([
            'customization_category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $imagePath,
        ]);

        $this->resetForm();
        session()->flash('success', 'Option created successfully!');
    }

    public function edit($id)
    {
        $option = CustomizationOption::findOrFail($id);
        $this->option_id = $option->id;
        $this->name = $option->name;
        $this->price = $option->price;
        $this->image = $option->image;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $option = CustomizationOption::findOrFail($this->option_id);

        $path = $this->newImage
            ? $this->newImage->store('customization_options', 'public')
            : $option->image;

        $option->update([
            'name' => $this->name,
            'price' => $this->price,
            'image' => $path,
        ]);

        $this->resetForm();
        session()->flash('success', 'Option updated successfully!');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        CustomizationOption::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        session()->flash('success', 'Option deleted.');
    }

    public function resetForm()
    {
        $this->reset(['name', 'price', 'image', 'newImage', 'isEditing', 'option_id']);
    }

    public function render()
    {
        return view('livewire.backend.customization-category.options', [
            'options' => CustomizationOption::where('customization_category_id', $this->category_id)
                ->latest()
                ->get(),
            'category' => CustomizationCategory::find($this->category_id),
        ]);
    }


}
