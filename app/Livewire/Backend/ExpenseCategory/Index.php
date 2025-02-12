<?php

namespace App\Livewire\Backend\ExpenseCategory;

use App\Models\ExpenseCategory;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $categoryId;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        ExpenseCategory::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Expense category created successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $category = ExpenseCategory::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $category = ExpenseCategory::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Expense category updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        ExpenseCategory::find($id)->delete();
        session()->flash('message', 'Expense category deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'categoryId', 'isEdit']);
    }

    public function render()
    {
        $categories = ExpenseCategory::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.backend.expense-category.index', compact('categories'));
    }
}
