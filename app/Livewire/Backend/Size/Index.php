<?php

namespace App\Livewire\Backend\Size;

use App\Models\Size;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $slug, $size, $sizeId;
    public $search = '';
    public $sortBy = 'name'; // Default sorting column
    public $sortDirection = 'asc'; // Default sorting direction

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:sizes,slug',
        'size' => 'nullable|string|max:255',
    ];

    // Generate slug dynamically
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    // Save or update a size
    public function store()
    {
        // Dynamic rule for slug uniqueness during update
        $this->rules['slug'] = 'required|string|max:255|unique:sizes,slug,' . ($this->sizeId ?? '0');
        $this->validate();

        Size::updateOrCreate(
            ['id' => $this->sizeId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'size' => $this->size,
            ]
        );

        session()->flash('message', $this->sizeId ? 'Size updated successfully.' : 'Size created successfully.');

        $this->resetInputFields();
    }

    // Edit size
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        $this->sizeId = $size->id;
        $this->name = $size->name;
        $this->slug = $size->slug;
        $this->size = $size->size;
    }

    // Delete size
    public function delete($id)
    {
        Size::findOrFail($id)->delete();
        session()->flash('message', 'Size deleted successfully.');
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->size = '';
        $this->sizeId = null;
    }

    // Toggle sorting
    public function toggleSort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Render component
    public function render()
    {
        $sizes = Size::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.size.index', compact('sizes'));
    }
}
