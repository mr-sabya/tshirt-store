<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Order;
use Livewire\Component;

class OrderConfirmation extends Component
{
    public $order;

    // The order ID will be passed via the route parameter
    public function mount($orderId)
    {
        $this->order = Order::with('orderItems.product', 'orderItems.size', 'orderItems.productVariation')
            ->where('id', $orderId)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.checkout.order-confirmation', [
            'order' => $this->order
        ]);
    }
}