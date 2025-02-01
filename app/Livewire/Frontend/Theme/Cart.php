<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }


    public function loadCart()
    {
        $this->cartItems = ModelsCart::where('user_id', Auth::id())
            ->with(['product', 'variation', 'size'])
            ->get();
    }


    public function removeItem($id)
    {
        ModelsCart::destroy($id);
        $this->loadCart();
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
    }

    public function updateQuantity($id, $quantity)
    {
        $cart = ModelsCart::find($id);
        if ($cart) {
            $cart->update(['quantity' => $quantity]);
            $this->loadCart();
        }
    }

    private function getCartItemIndexById($id)
    {
        return collect($this->cartItems)->search(fn($cart) => $cart['id'] === $id);
    }


    public function render()
    {
        return view('livewire.frontend.theme.cart');
    }
}
