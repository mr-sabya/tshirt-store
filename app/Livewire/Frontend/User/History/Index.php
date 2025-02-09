<?php

namespace App\Livewire\Frontend\User\History;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product') // Eager load order items and their products
            ->latest()
            ->get();

        return view('livewire.frontend.user.history.index', compact('orders'));
    }
}
