<?php

namespace App\Livewire\Backend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout(); // Log the user out

        // Redirect to login page or another route after logging out
        return $this->redirect(route('admin.login'), navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.auth.logout');
    }
}
