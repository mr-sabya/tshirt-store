<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Cart;
use App\Models\Product as ModelsProduct;
use App\Models\ProductVariation;
use App\Models\Setting;
use App\Models\Wishlist;
use Hamcrest\Core\Set;
use Livewire\Component;

class Product extends Component
{
    public $productId;
    public $selectedVariationId;
    public $selectedSizeId;
    public $quantity = 1;
    public $data_image, $data_image_hover;
    public $isInWishlist = false;
    public $settings;

    public function mount($productId)
    {
        $this->settings = Setting::first();
        $this->productId = $productId;
        $this->setInitialSelections();
        $this->checkWishlistStatus(); // Check if the product is in the wishlist
    }

    public function setInitialSelections()
    {
        // Get the product with its variations and sizes
        $product = ModelsProduct::with(['variations', 'sizes'])->find($this->productId);

        if ($product) {
            // Set the first variation as the default selected variation
            $this->selectedVariationId = $product->variations->first()->id ?? null;

            // Set the first size as the default selected size
            $this->selectedSizeId = $product->sizes->first()->id ?? null;
        }
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        // Get the product details
        $product = ModelsProduct::find($this->productId);

        if (!$product) {
            return back()->with('error', 'Product not found');
        }

        // Add to cart logic
        $userId = auth()->id(); // Get the current logged-in user's ID

        // dd($this->selectedSizeId);
        Cart::addItem($userId, $product->id, $this->selectedVariationId, $this->selectedSizeId, $this->quantity);

        // Emit event to update the cart count in the parent component
        $this->dispatch('cartUpdated');

        // Dispatch the Facebook Pixel event for "AddToCart"
        $this->dispatch('pixelEvent', [
            'event' => 'AddToCart',
            'data' => [
                'content_ids' => [$this->productId],
                'content_type' => 'product',
                'value' => $product->price * $this->quantity, // Assuming you have a price field in the product model
                'currency' => $this->settings['currency'], // Update the currency if needed
            ]
        ]);
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $product = ModelsProduct::find($this->productId);

        if ($product) {
            // Call the helper method to add the item to the wishlist
            Wishlist::addItem(
                auth()->id(),
                $product->id,
                $this->selectedVariationId,
                $this->selectedSizeId
            );

            $this->dispatch('wishListUpdated');

            $this->checkWishlistStatus(); // Check if the product is in the wishlist
        } else {
            session()->flash('error', 'Please select color and size.');
        }
    }


    public function setSelectedVariation($variationId)
    {
        $this->selectedVariationId = $variationId;
        $variation = ProductVariation::find($variationId);
        if ($variation) {
            $this->selectedVariationId = $variationId;
            $this->data_image = url('storage/' . $variation->image);
            $this->data_image_hover = url('storage/' . $variation->image);  // You can change this to another hover image URL if needed.
        }
        $this->checkWishlistStatus(); // Check if the product is in the wishlist
    }

    public function setSelectedSize($sizeId)
    {
        $this->selectedSizeId = $sizeId;
        $this->checkWishlistStatus(); // Check if the product is in the wishlist
    }

    public function checkWishlistStatus()
    {
        // Build the base query
        $query = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $this->productId);

        // Conditionally add the variation check if selectedVariationId is not null
        if ($this->selectedVariationId !== null) {
            $query->where('product_variation_id', $this->selectedVariationId);
        }

        // Conditionally add the size check if selectedSizeId is not null
        if ($this->selectedSizeId !== null) {
            $query->where('size_id', $this->selectedSizeId);
        }

        // Check if the item exists in the wishlist
        $this->isInWishlist = $query->exists();
    }

    public function render()
    {
        $product = ModelsProduct::where('id', $this->productId)->first();
        return view('livewire.frontend.components.product', [
            'product' => $product,
        ]);
    }
}
