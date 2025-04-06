<?php

namespace App\Livewire\Frontend\User\OrderTrack;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $orderID;

    public function mount($orderID)
    {
        $this->orderID = $orderID;
    }

    public function render()
    {
        return view('livewire.frontend.user.order-track.index',[
            'order' => Order::where('order_id', $this->orderID)->firstOrFail(),
        ]);
    }
}
