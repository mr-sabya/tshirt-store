<?php

namespace App\Livewire\Frontend\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        return $this->redirect(route('login'), navigate:true);
    }

    public function render()
    {
        return view('livewire.frontend.user.logout');
    }
}
