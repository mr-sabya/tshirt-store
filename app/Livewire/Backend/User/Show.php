<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $user;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
    }

    public function approve()
    {
        $this->user->update(['is_approved' => true, 'is_designer' => true]);
        session()->flash('message', 'User has been approved as a designer!');
    }

    public function render()
    {
        return view('livewire.backend.user.show');
    }
}
