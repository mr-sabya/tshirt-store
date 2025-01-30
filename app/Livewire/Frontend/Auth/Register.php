<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\City;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $divisions, $cities = [], $division_id, $city_id, $name, $phone, $address, $postcode, $password, $password_confirmation;
    public $passwordMismatch = false;

    // This will load divisions on mount
    public function mount()
    {
        $this->divisions = Division::all();
    }

    // Method to fetch cities based on division
    public function getCity()
    {
        // Fetch cities based on selected division
        $this->cities = City::where('division_id', $this->division_id)->get();
    }


    public function checkPasswordMatch()
    {
        // Compare password and password_confirmation
        if ($this->password !== $this->password_confirmation) {
            $this->passwordMismatch = true;
        } else {
            $this->passwordMismatch = false;
        }
    }

    // Handle form submission
    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'postcode' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed', // Password validation
        ]);

        // Create user with hashed password
        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'division_id' => $this->division_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'password' => Hash::make($this->password), // Hash the password before saving
            'is_verified' => false, // Set default value for is_verified
        ]);

        // Log the user in
        Auth::login($user);

        session()->flash('message', 'Registration successful! You are now logged in.');
        return redirect()->route('home'); // Redirect to home or dashboard after login
    }

    public function render()
    {
        return view('livewire.frontend.auth.register');
    }
}
