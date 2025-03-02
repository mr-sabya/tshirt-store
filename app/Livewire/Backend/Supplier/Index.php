<?php

namespace App\Livewire\Backend\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $name, $email, $phone, $address, $company, $notes;
    public $supplierId, $search = '';
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'company' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ];

    protected $queryString = ['search'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'company' => $this->company,
            'notes' => $this->notes,
        ]);

        session()->flash('message', 'Supplier added successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->supplierId = $id;
        $supplier = Supplier::findOrFail($id);
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
        $this->company = $supplier->company;
        $this->notes = $supplier->notes;

        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $supplier = Supplier::findOrFail($this->supplierId);
        $supplier->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'company' => $this->company,
            'notes' => $this->notes,
        ]);

        session()->flash('message', 'Supplier updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        Supplier::findOrFail($id)->delete();
        session()->flash('message', 'Supplier deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = $this->email = $this->phone = $this->address = $this->company = $this->notes = '';
        $this->supplierId = null;
    }

    public function render()
    {
        $suppliers = Supplier::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('company', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.backend.supplier.index', compact('suppliers'));
    }

}
