<?php

namespace App\Livewire\Frontend\User\Design;

use App\Models\User;
use App\Notifications\DesignerApplicationNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Apply extends Component
{
    public $user;
    public $message;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function apply()
    {
        if ($this->user) {
            $this->user->update(['is_designer' => true, 'is_approved' => false]);
            $this->message = 'Your application has been submitted. Please wait for approval.';

            // Notify admin
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                $admin->notify(new DesignerApplicationNotification($this->user));
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.user.design.apply', [
            'infoText' => 'Unlock new earning opportunities by becoming a designer on our platform! As a designer, you can showcase your creativity by uploading unique T-shirt designs. Every time a customer purchases a T-shirt featuring your design, you will earn a percentage of the sale. This is a great way to turn your artistic talent into a sustainable income stream while reaching a global audience. Apply now and start your journey as a professional T-shirt designer!',
            'notApprovedMessage' => $this->user->is_designer && !$this->user->is_approved ? 'Your application is under review. Please wait for admin approval.' : null
        ]);
    }
}
