<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use Livewire\Component;

class Show extends Component
{
    public $productId;
    public $selectedVariationId;
    public $selectedSizeId;
    public $quantity = 1;
    public $data_image, $data_image_hover;

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
        // dd($this->quantity);
        $product = Product::find($this->productId);

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
            $this->quantity = 1;
        } else {
            session()->flash('error', 'Please select color and size.');
        }
    }

    public function buyNow()
    {
        // Validate if product, variation, and size are selected
        $product = Product::find($this->productId);

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

            // Redirect to checkout (or handle according to your flow)
            return $this->redirect(route('user.checkout'), navigate:true);
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
