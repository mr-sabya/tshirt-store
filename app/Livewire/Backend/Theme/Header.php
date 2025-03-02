<?php

namespace App\Livewire\Backend\Theme;

use Livewire\Component;

class Header extends Component
{
    public $notifications;
    public $unreadCount;

    public function mount()
    {
        // Fetch unread notifications and count
        $this->notifications = auth()->user()->unreadNotifications;
        $this->unreadCount = $this->notifications->count();
    }

    public function render()
    {
        return view('livewire.backend.theme.header');
    }
}
