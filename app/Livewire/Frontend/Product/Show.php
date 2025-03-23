<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $productId;
    public $selectedVariationId;
    public $selectedSizeId;
    public $quantity = 1;
    public $data_image, $data_image_hover;

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
    }

    public function setInitialSelections()
    {
        // Get the product with its variations and sizes
        $product = Product::with(['variations', 'sizes'])->find($this->productId);

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

        if (!$this->selectedSizeId) {
            session()->flash('error', 'Please select a size.');
            return;
        }

        if ($product) {
            // Check if the product with the selected size (variation is optional) is already in the cart
            $existingCartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $this->productId)
                ->where('size_id', $this->selectedSizeId);

            if ($this->selectedVariationId) {
                $existingCartItem->where('product_variation_id', $this->selectedVariationId);
            }

            $existingCartItem = $existingCartItem->first();

            if ($existingCartItem) {
                // If the product is already in the cart, update the quantity
                $existingCartItem->quantity += $this->quantity;
                $existingCartItem->save();
            } else {
                // If the product is not in the cart, add it
                Cart::addItem(auth()->id(), $this->productId, $this->selectedVariationId, $this->selectedSizeId, $this->quantity);
            }

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




    public function setSelectedVariation($variationId)
    {
        $this->selectedVariationId = $variationId;
        $variation = ProductVariation::find($variationId);
        if ($variation) {
            $this->selectedVariationId = $variationId;
            $this->data_image = url('storage', $variation->image);
            $this->data_image_hover = url('storage', $variation->image);  // You can change this to another hover image URL if needed.
        }
    }

    public function setSelectedSize($sizeId)
    {
        $this->selectedSizeId = $sizeId;
    }

    public function render()
    {
        $product = Product::where('id', $this->productId)->first();
        return view('livewire.frontend.product.show', [
            'product' => $product,
        ]);
    }
}
