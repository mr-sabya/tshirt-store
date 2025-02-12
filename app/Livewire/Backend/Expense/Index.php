<?php

namespace App\Livewire\Backend\Expense;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $category_id, $amount, $description, $date, $expenseId;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'category_id' => 'required|exists:expense_categories,id',
        'amount' => 'required|numeric',
        'description' => 'required|string|max:255',
        'date' => 'required|date',
    ];



    public function save()
    {
        $this->validate();

        Expense::create([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        session()->flash('message', 'Expense added successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $expense = Expense::findOrFail($id);

        $this->expenseId = $expense->id;
        $this->category_id = $expense->category_id;
        $this->amount = $expense->amount;
        $this->description = $expense->description;
        $this->date = $expense->date;
    }

    public function update()
    {
        $this->validate();

        $expense = Expense::findOrFail($this->expenseId);
        $expense->update([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        session()->flash('message', 'Expense updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        Expense::find($id)->delete();
        session()->flash('message', 'Expense deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['category_id', 'amount', 'description', 'date', 'expenseId', 'isEdit']);
    }

    public function render()
    {
        $categories = ExpenseCategory::all();
        $expenses = Expense::where('description', 'like', '%' . $this->search . '%')
                           ->orWhereHas('category', function($query) {
                               $query->where('name', 'like', '%' . $this->search . '%');
                           })
                           ->paginate(10);

        return view('livewire.backend.expense.index', compact('categories', 'expenses'));
    }

}
