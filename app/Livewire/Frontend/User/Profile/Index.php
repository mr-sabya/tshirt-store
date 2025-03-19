<?php

namespace App\Livewire\Frontend\User\Profile;

use App\Models\City;
use App\Models\Division;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $image;
    public $address;
    public $division_id;
    public $city_id;
    public $postcode;
    public $divisions;
    public $cities = [];

    public function mount()
    {
        $this->address = auth()->user()->address;
        $this->division_id = auth()->user()->division_id;
        $this->city_id = auth()->user()->city_id;
        $this->postcode = auth()->user()->postcode;

        // Get all divisions
        $this->divisions = Division::all();

        // Get cities for the selected division
        if ($this->division_id) {
            $this->cities = City::where('division_id', $this->division_id)->get();
        }
    }

     // Method to fetch cities based on division
     public function getCity()
     {
         // Fetch cities based on selected division
         $this->cities = City::where('division_id', $this->division_id)->get();
     }
 

    // Update profile method
    public function updateProfile()
    {
        $user = User::find(auth()->id());

        // Validation (You can add more validation if necessary)
        $this->validate([
            'address' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'city_id' => 'required|exists:cities,id',
            'postcode' => 'required|string|max:20',
        ]);


        // Update user details
        $user->address = $this->address;
        $user->division_id = $this->division_id;
        $user->city_id = $this->city_id;
        $user->postcode = $this->postcode;
        $user->save();

        // Emit a success message or notify the user
        session()->flash('message', 'Profile updated successfully!');
        $this->dispatch('profileUpdated'); // Emit event for livewire notifications
    }


    // Update image only
    public function updateImage()
    {
        $user = User::find(auth()->id());

        // Validate the image input
        $this->validate([
            'image' => 'nullable|image|max:1024', // Max 1MB image size
        ]);

        // Handle image upload
        if ($this->image) {
            $imagePath = $this->image->store('profile_images', 'public');
            $user->image = $imagePath;
            $user->save();

            // Flash success message
            session()->flash('message', 'Image updated successfully!');
        }
    }

    // Update cities based on selected division
    public function updatedDivisionId($divisionId)
    {
        $this->cities = City::where('division_id', $divisionId)->get();
    }

    public function render()
    {
        return view('livewire.frontend.user.profile.index');
    }
}
