<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartButton extends Component
{
    public $cartItemsCount;

    public function mount()
    {
        // Initial cart count when the component is first loaded
        $this->cartItemsCount = Cart::where('user_id', Auth::user()->id)->count();
    }

    // This method will be called when the 'cart-updated' event is fired
    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function updateCartCount()
    {
        // Update the cart count whenever the event is fired
        $this->cartItemsCount = Cart::where('user_id', Auth::user()->id)->count();
    }

    public function render()
    {
        return view('livewire.frontend.theme.cart-button', [
            'cartItems' => $this->cartItemsCount,
        ]);
    }

}
