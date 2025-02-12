<?php

namespace App\Livewire\Backend\CallHistory;

use App\Models\CallHistory;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $leadId;
    public $feedback;
    public $call_time;
    public $callHistoryId;
    public $search = '';
    public $isAssignedUser = false; 

    protected $rules = [
        'feedback' => 'required|string|max:255',
        'call_time' => 'required|date',
    ];

    public function mount($leadId)
    {
        $this->leadId = $leadId;
        $this->checkAssignedUser();
    }

    public function checkAssignedUser()
    {
        // Check if the logged-in user is the one assigned to the lead
        $lead = Lead::findOrFail($this->leadId);
        $this->isAssignedUser = $lead->assigned_to == Auth::id();
        if ($lead->assigned_to != Auth::id()) {
            abort(403, 'You are not authorized to edit this call history.');
        }
    }

    public function getCallHistories()
    {
        return CallHistory::where('lead_id', $this->leadId)
                          ->where('feedback', 'like', '%' . $this->search . '%')
                          ->latest()
                          ->paginate(10);  // Pagination applied
    }

    public function addCallHistory()
    {
        $this->validate();

        CallHistory::create([
            'lead_id' => $this->leadId,
            'feedback' => $this->feedback,
            'call_time' => $this->call_time,
        ]);

        session()->flash('message', 'Call history added successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $callHistory = CallHistory::findOrFail($id);
        $this->callHistoryId = $callHistory->id;
        $this->feedback = $callHistory->feedback;
        $this->call_time = $callHistory->call_time;
    }

    public function updateCallHistory()
    {
        $this->validate();

        $callHistory = CallHistory::findOrFail($this->callHistoryId);
        $callHistory->update([
            'feedback' => $this->feedback,
            'call_time' => $this->call_time,
        ]);

        session()->flash('message', 'Call history updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        CallHistory::findOrFail($id)->delete();
        session()->flash('message', 'Call history deleted successfully!');
    }

    public function resetForm()
    {
        $this->feedback = '';
        $this->call_time = '';
        $this->callHistoryId = null;
    }

    public function render()
    {
        $callHistories = $this->getCallHistories();
        $lead = Lead::findOrFail($this->leadId);

        return view('livewire.backend.call-history.index', compact('callHistories', 'lead'));
    }
}
