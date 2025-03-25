<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Setting;
use App\Models\Wishlist;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $productId;
    public $selectedVariationId;
    public $selectedSizeId;
    public $quantity = 1;
    public $data_image, $data_image_hover;
    public $isProductStock = true;
    public $isInWishlist = false;

    public $settings;

    // Method to update the quantity
    public function updateQuantity($operation)
    {
        if ($operation === 'increment') {
            $this->quantity++;
        } elseif ($operation === 'decrement' && $this->quantity > 1) {
            $this->quantity--;
        }
    }


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
        $product = Product::with(['variations', 'sizes'])->find($this->productId);
        $this->product = $product;

        if ($product) {
            // Set the first variation as the default selected variation
            $this->selectedVariationId = $product->variations->first()->id ?? null;

            // Set the first size as the default selected size
            $this->selectedSizeId = $product->sizes->first()->id ?? null;

            $this->checkStock($this->selectedSizeId);
        }
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            session()->put('redirect_url', url()->previous()); // Store the last visited page
            return $this->redirect(route('login'), navigate: true);
        }

        // Get the product details
        $product = Product::find($this->productId);

        if (!$product) {
            return back()->with('error', 'Product not found');
        }
        // Add to cart logic
        $userId = auth()->id(); // Get the current logged-in user's ID

        // dd($this->selectedSizeId);
        Cart::addItem($userId, $product->id, $this->selectedVariationId, $this->selectedSizeId, $this->quantity);

        // Dispatch event for Facebook Pixel tracking
        $this->dispatch('addToCartPixel', [
            'product_id' => $this->productId,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $this->quantity,
            'currency' => $this->settings['currency'], // Change currency if needed
        ]);

        // Emit event to update the cart count in the parent component
        $this->dispatch('cartUpdated');
        $this->quantity = 1;
    }


    public function buyNow()
    {
        if (!Auth::check()) {
            session()->put('redirect_url', url()->previous());
            return $this->redirect(route('login'), navigate: true);
        }
        // Validate if product, variation, and size are selected
        $product = Product::find($this->productId);

        if ($product) {
            // Add to cart logic
            $userId = auth()->id(); // Get the current logged-in user's ID

            // dd($this->selectedSizeId);
            Cart::addItem($userId, $product->id, $this->selectedVariationId, $this->selectedSizeId, $this->quantity);

            $this->dispatch('cartUpdated');

            // Dispatch event for Facebook Pixel tracking (Buy Now)
            $this->dispatch('buyNowPixel', [
                'product_id' => $this->productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $this->quantity,
                'currency' => $this->settings['currency'], // Change currency if needed
            ]);

            // Redirect to checkout
            return $this->redirect(route('user.checkout'), navigate: true);
        }
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $product = Product::find($this->productId);

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

    public function setSelectedVariation($variationId)
    {
        $this->selectedVariationId = $variationId;
        $variation = ProductVariation::find($variationId);
        if ($variation) {
            $this->selectedVariationId = $variationId;
            $this->data_image = url('storage', $variation->image);
            $this->data_image_hover = url('storage', $variation->image);  // You can change this to another hover image URL if needed.
        }
        $this->checkWishlistStatus(); // Check if the product is in the wishlist
    }

    public function setSelectedSize($sizeId)
    {
        $this->selectedSizeId = $sizeId;
        $this->checkStock($this->selectedSizeId);
        $this->checkWishlistStatus(); // Check if the product is in the wishlist
    }

    public function checkStock($sizeId)
    {
        $stock = $this->product->getSizeStock($sizeId);

        if ($stock !== false) {
            $this->isProductStock = true;
        } else {
            $this->isProductStock = false;
        }
    }

    public function render()
    {
        $product = Product::where('id', $this->productId)->first();
        return view('livewire.frontend.product.show', [
            'product' => $product,
        ]);
    }
}
