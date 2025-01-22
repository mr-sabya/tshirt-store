<?php

namespace App\Livewire\Backend\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $slug, $color, $colorId;
    public $search = '';
    public $sortBy = 'name'; // Default sorting column
    public $sortDirection = 'asc'; // Default sorting direction

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:colors,slug',
        'color' => 'required|string|max:255',
    ];

    // Generate slug automatically from the name
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    // Save or update a color
    public function store()
    {
        $this->rules['slug'] = 'required|string|max:255|unique:colors,slug,' . ($this->colorId ?? '0');

        $this->validate();

        Color::updateOrCreate(
            ['id' => $this->colorId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'color' => $this->color,
            ]
        );

        session()->flash('message', $this->colorId ? 'Color updated successfully.' : 'Color created successfully.');

        $this->resetInputFields();
    }

    // Edit a color
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        $this->colorId = $color->id;
        $this->name = $color->name;
        $this->slug = $color->slug;
        $this->color = $color->color;
    }

    // Delete a color
    public function delete($id)
    {
        Color::findOrFail($id)->delete();
        session()->flash('message', 'Color deleted successfully.');
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->color = '';
        $this->colorId = null;
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

    public function render()
    {
        $colors = Color::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.color.index', compact('colors'));
    }
}
