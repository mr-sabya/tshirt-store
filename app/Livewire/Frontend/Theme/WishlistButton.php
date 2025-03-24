<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistButton extends Component
{
    

    public $wishlistItemCount;

    public function mount()
    {
        // Initial cart count when the component is first loaded
        $this->wishlistItemCount = Wishlist::where('user_id', Auth::user()->id)->count();
    }

    // This method will be called when the 'cart-updated' event is fired
    protected $listeners = ['wishListUpdated' => 'updateWishistCount'];

    public function updateWishistCount()
    {
        // Update the cart count whenever the event is fired
        $this->wishlistItemCount = Wishlist::where('user_id', Auth::user()->id)->count();
    }

    public function render()
    {
        return view('livewire.frontend.theme.wishlist-button', [
            'wishlistItems' => $this->wishlistItemCount,
        ]);
    }
}
