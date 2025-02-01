<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    public $cartItems = [];
    public $total = 0;
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


    public function render()
    {
        return view('livewire.frontend.checkout.index', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }

}
