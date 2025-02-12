<?php

namespace App\Livewire\Backend\Lead;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $email, $phone, $source, $status, $notes, $assigned_to, $converted_at;
    public $leadId, $search = '', $isEdit = false, $users;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:leads,email',
        'phone' => 'nullable|string|max:15|unique:leads,phone',
        'source' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:255',
        'notes' => 'nullable|string|max:1000',
        'assigned_to' => 'nullable|exists:users,id',
        'converted_at' => 'nullable|date',
    ];

    public function mount()
    {
        // Initial setup, for example, fetching the users for assignment
        $this->users = User::where('is_admin', 1)->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Edit function
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $this->leadId = $lead->id;
        $this->name = $lead->name;
        $this->email = $lead->email;
        $this->phone = $lead->phone;
        $this->source = $lead->source;
        $this->status = $lead->status;
        $this->notes = $lead->notes;
        $this->assigned_to = $lead->assigned_to;
        $this->converted_at = $lead->converted_at;

        $this->isEdit = true;
    }

    // Reset form fields
    public function resetForm()
    {
        $this->reset([
            'name', 'email', 'phone', 'source', 'status', 'notes', 'assigned_to', 'converted_at', 'leadId', 'isEdit'
        ]);
    }

    // Save function
    public function save()
    {
        $this->validate();

        Lead::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'source' => $this->source,
            'status' => $this->status,
            'notes' => $this->notes,
            'assigned_to' => $this->assigned_to,
            'converted_at' => $this->converted_at,
        ]);

        session()->flash('message', 'Lead added successfully!');
        $this->resetForm();
    }

    // Update function
    public function update()
    {
        $this->validate([
            'email' => ['required', 'email', Rule::unique('leads')->ignore($this->leadId)],
            'phone' => ['nullable', 'string', 'max:15', Rule::unique('leads')->ignore($this->leadId)],
        ]);

        $lead = Lead::find($this->leadId);
        $lead->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'source' => $this->source,
            'status' => $this->status,
            'notes' => $this->notes,
            'assigned_to' => $this->assigned_to,
            'converted_at' => $this->converted_at,
        ]);

        session()->flash('message', 'Lead updated successfully!');
        $this->resetForm();
    }

    // Delete function
    public function delete($id)
    {
        Lead::find($id)->delete();
        session()->flash('message', 'Lead deleted successfully!');
    }

    // Render the view
    public function render()
    {
        $leads = Lead::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.backend.lead.index', compact('leads'));
    }

}
