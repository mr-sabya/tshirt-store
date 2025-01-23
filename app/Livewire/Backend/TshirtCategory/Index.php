<?php

namespace App\Livewire\Backend\TshirtCategory;

use App\Models\TshirtCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $slug, $categoryId;
    public $search = '';
    public $isEdit = false;
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:tshirt_categories,slug',
    ];


    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function toggleSort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'slug', 'isEdit', 'categoryId']);
    }

    public function save()
    {
        $this->validate();

        TshirtCategory::create([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        $this->resetForm();
        session()->flash('message', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = TshirtCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'slug' => 'required|string|max:255|unique:tshirt_categories,slug,' . $this->categoryId,
        ]);

        $category = TshirtCategory::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        $this->resetForm();
        session()->flash('message', 'Category updated successfully.');
    }

    public function delete($id)
    {
        TshirtCategory::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function render()
    {
        $categories = TshirtCategory::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.tshirt-category.index', compact('categories'));
    }
}
