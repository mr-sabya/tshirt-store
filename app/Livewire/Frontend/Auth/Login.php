<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $phone; // Store phone number
    public $password;

    // Handle the login logic
    public function login()
    {
        // Validate the login data
        $this->validate([
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        // Check if the phone number exists and find the user
        $user = User::where('phone', $this->phone)->first();

        // If the user exists and the password is correct
        if ($user && Auth::attempt(['phone' => $this->phone, 'password' => $this->password])) {
            // Login successful, redirect to a page (e.g., dashboard)
            session()->flash('message', 'Login successful');
            return $this->redirect(route('home'), navigate:true);  // Adjust the redirect route as needed
        } else {
            // Login failed
            session()->flash('message', 'Invalid credentials');
        }
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
