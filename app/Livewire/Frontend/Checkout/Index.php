<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class Index extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $deliveryCharge = 10.00;
    public $paymentMethod = 'Cash On Delivery';
    public $comment = '';
    public $couponCode = '';
    public $isAgreed = false;
    protected $listeners = ['cartUpdated' => 'loadCart'];

    // This will be executed when the component is mounted
    public function mount()
    {
        $this->loadCart();
    }

    // Method to load cart items and calculate the total
    public function loadCart()
    {
        $userId = auth()->id(); // Assuming the user is authenticated
        $this->cartItems = Cart::with('product', 'variation', 'size')
            ->where('user_id', $userId)
            ->get();

        $this->total = collect($this->cartItems)->sum(function ($item) {
            return $item->quantity * $item->product->price; // Assuming each product has a price
        });
    }

    // Method to apply a coupon and adjust the total
    public function applyCoupon()
    {
        if ($this->couponCode == 'DISCOUNT10') {
            $this->total -= 10; // Apply discount (for example, 10)
        }
    }

    // Method to place the order
    public function placeOrder()
    {
        // Validate that user has agreed to terms and conditions
        if (!$this->isAgreed) {
            session()->flash('error', 'You must agree to the terms and conditions.');
            return;
        }

        // Store order data
        $order = Order::create([
            'user_id' => auth()->id(),
            'subtotal' => $this->total,
            'delivery_charge' => $this->deliveryCharge,
            'discount' => 0, // Add discount if applied
            'total' => $this->total + $this->deliveryCharge,
            'payment_method' => $this->paymentMethod,
            'comment' => $this->comment,
            'status' => 'pending', // You can update the status as needed
        ]);

        // Store order items
        foreach ($this->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'size_id' => $cartItem->size->id,
                'product_variation_id' => $cartItem->variation->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        // Redirect to order confirmation page (you can adjust the route as needed)
        return redirect()->route('order.confirmation', $order->id);
    }


    public function render()
    {
        return view('livewire.frontend.checkout.index', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
