<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use App\Models\DeliveryCharge;
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

    // Method to remove an item from the cart
    public function removeItem($cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
        $cartItem->delete();
        $this->loadCart(); // Reload cart after removal
    }


    public function increaseQuantity($id)
    {
        $index = $this->getCartItemIndexById($id);
        if ($index !== null) {
            $this->cartItems[$index]['quantity'] += 1; // Increase quantity in the cartItems array
            $this->updateQuantity($id, $this->cartItems[$index]['quantity']);
        }
    }

    public function decreaseQuantity($id)
    {
        $index = $this->getCartItemIndexById($id);
        if ($index !== null && $this->cartItems[$index]['quantity'] > 1) {
            $this->cartItems[$index]['quantity'] -= 1; // Decrease quantity in the cartItems array
            $this->updateQuantity($id, $this->cartItems[$index]['quantity']);
        }
        $this->dispatch('cartUpdated');
    }

    public function updateQuantity($id, $quantity)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->update(['quantity' => $quantity]);
            $this->loadCart();
        }
        $this->dispatch('cartUpdated');
    }

    private function getCartItemIndexById($id)
    {
        return collect($this->cartItems)->search(fn($cart) => $cart['id'] === $id);
    }

    public function render()
    {
        return view('livewire.frontend.cart.index', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
            'deliveryCharge' => DeliveryCharge::where('city_id', auth()->user()->city_id)->first(),
        ]);
    }
}
