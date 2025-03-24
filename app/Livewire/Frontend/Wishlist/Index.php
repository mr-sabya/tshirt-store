<?php

namespace App\Livewire\Frontend\Wishlist;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Wishlist;
use Livewire\Component;

class Index extends Component
{
    public $wishlistItems, $settings;

    public function mount()
    {
        $this->settings = Setting::first();
        $this->wishlistItems = Wishlist::where('user_id', auth()->id())->get();
    }

    public function moveToCart($itemId)
    {
        $item = Wishlist::find($itemId);
        if ($item) {

            $product = Product::find($item->product_id);
            // Add to cart logic
            $userId = auth()->id(); // Get the current logged-in user's ID

            // dd($this->selectedSizeId);
            Cart::addItem($userId, $product->id, $item->product_variation_id, $item->size_id, 1);



            // Remove the item from the wishlist
            $item->delete();

            // Refresh the wishlist items
            $this->mount();

            // Emit event to update the cart count in the parent component
            $this->dispatch('cartUpdated');

            // Dispatch the Facebook Pixel event for "AddToCart"
            $this->dispatch('pixelEvent', [
                'event' => 'AddToCart',
                'data' => [
                    'content_ids' => [$product->id],
                    'content_type' => 'product',
                    'value' => $product->price * 1, // Assuming you have a price field in the product model
                    'currency' => $this->settings['currency'], // Update the currency if needed
                ]
            ]);
        }
    }

    public function buyNow($itemId)
    {
        $item = Wishlist::find($itemId);
        if ($item) {
            // Validate if product, variation, and size are selected
            $product = Product::find($item->product_id);

            if ($product) {
                // Add to cart logic
                $userId = auth()->id(); // Get the current logged-in user's ID

                // dd($this->selectedSizeId);
                Cart::addItem($userId, $product->id, $item->product_variation_id, $item->size_id, 1);

                // Remove the item from the wishlist
                $item->delete();

                $this->dispatch('cartUpdated');

                // Dispatch event for Facebook Pixel tracking (Buy Now)
                $this->dispatch('buyNowPixel', [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'currency' => $this->settings['currency'], // Change currency if needed
                ]);

                // Redirect to checkout
                return $this->redirect(route('user.checkout'), navigate: true);
            }
        }
    }

    public function removeItem($itemId)
    {
        $item = Wishlist::find($itemId);
        $item->delete();
        $this->mount();  // Refresh the wishlist items
    }

    public function render()
    {
        return view('livewire.frontend.wishlist.index');
    }
}
