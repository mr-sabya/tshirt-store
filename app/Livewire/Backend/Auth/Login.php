<?php

namespace App\Livewire\Backend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $phone;
    public $password;
    public $remember = false;

    protected $rules = [
        'phone' => 'required|numeric',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        // Attempt to log in using phone and password as admin
        if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password, 'is_admin' => 1], $this->remember)) {
            // Redirect to admin dashboard on success
            return $this->redirect(route('admin.home'), navigate: true);
        }

        // Handle failed login
        session()->flash('error', 'Invalid phone number, password, or you are not an admin.');
    }
    
    public function render()
    {
        return view('livewire.backend.auth.login');
    }
}
