<?php

namespace App\Livewire\Backend\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::with(['orderItems.product', 'orderItems.size', 'orderItems.productVariation'])->find($orderId);
    }

    public function updateStatus($newStatus)
    {
        // Create a new order status entry
        $this->order->statuses()->create([
            'status' => $newStatus
        ]);

        // Update the order's current status
        $this->order->status = $newStatus;
        $this->order->save();
    }

    public function render()
    {
        return view('livewire.backend.order.show');
    }
}
