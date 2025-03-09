<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Cart;
use App\Models\Product as ModelsProduct;
use App\Models\ProductVariation;
use App\Models\Wishlist;
use Livewire\Component;

class Product extends Component
{
    public $productId;
    public $selectedVariationId;
    public $selectedSizeId;
    public $quantity = 1;
    public $data_image, $data_image_hover;
    public $isInWishlist = false;

    public function mount($productId)
    {
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
            return $this->redirect(route('login'), navigate:true);
        }
        // dd($this->selectedVariationId);
        $product = ModelsProduct::find($this->productId);

        if ($product && $this->selectedVariationId && $this->selectedSizeId) {
            // Check if the product with the selected variation and size is already in the cart
            $existingCartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $this->productId)
                ->where('product_variation_id', $this->selectedVariationId)
                ->where('size_id', $this->selectedSizeId)
                ->first();

            if ($existingCartItem) {
                // If the product is already in the cart, update the quantity
                $existingCartItem->quantity += $this->quantity;
                $existingCartItem->save();
            } else {
                // If the product is not in the cart, add it
                Cart::addItem(auth()->id(), $this->productId, $this->selectedVariationId, $this->selectedSizeId, $this->quantity);
            }

            // Emit event to update the cart count in the parent component
            $this->dispatch('cartUpdated');

            // Dispatch the Facebook Pixel event for "AddToCart"
            $this->dispatch('pixelEvent', [
                'event' => 'AddToCart',
                'data' => [
                    'content_ids' => [$this->productId],
                    'content_type' => 'product',
                    'value' => $product->price * $this->quantity, // Assuming you have a price field in the product model
                    'currency' => 'USD', // Update the currency if needed
                ]
            ]);
        } else {
            session()->flash('error', 'Please select color and size.');
        }
    }

    public function addToWishlist()
    {
        $product = ModelsProduct::find($this->productId);

        if ($product && $this->selectedVariationId && $this->selectedSizeId) {
            // Check if the product with the selected variation and size is already in the wishlist
            $existingWishlistItem = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $this->productId)
                ->where('product_variation_id', $this->selectedVariationId)
                ->where('size_id', $this->selectedSizeId)
                ->first();

            if (!$existingWishlistItem) {
                // If the product is not in the wishlist, add it
                Wishlist::create([
                    'user_id' => auth()->id(),
                    'product_id' => $this->productId,
                    'product_variation_id' => $this->selectedVariationId,
                    'size_id' => $this->selectedSizeId,
                ]);
                session()->flash('success', 'Product added to your wishlist!');
            } else {
                $existingWishlistItem->delete();
                session()->flash('info', 'This product is already in your wishlist.');
            }
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
    }

    public function setSelectedSize($sizeId)
    {
        $this->selectedSizeId = $sizeId;
    }

    public function checkWishlistStatus()
    {
        $this->isInWishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $this->productId)
            ->where('product_variation_id', $this->selectedVariationId)
            ->where('size_id', $this->selectedSizeId)
            ->exists();
    }

    public function render()
    {
        $product = ModelsProduct::where('id', $this->productId)->first();
        return view('livewire.frontend.components.product', [
            'product' => $product,
        ]);
    }
}
