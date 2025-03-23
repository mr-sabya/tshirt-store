<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $deliveryCharge;
    public $paymentMethod = 'Cash On Delivery';
    public $comment = '';
    public $couponCode = '';
    public $isAgreed = false;
    public $hasOutOfStockItems = false; // New property to track stock status
    protected $listeners = ['cartUpdated' => 'loadCart'];

    public $buyNowProduct = null;  // Add a property to handle buyNow product
    public $settings;

    // This will be executed when the component is mounted
    public function mount($buyNowProduct = null)
    {
        // dd($this->hasOutOfStockItems);
        $this->settings = Setting::first();
        $this->buyNowProduct = $buyNowProduct;
        $this->loadCart();

        // get default payment method
        $this->paymentMethod = PaymentMethod::where('is_active', 1)->first()->id;
        $this->deliveryCharge = DeliveryCharge::where('city_id', Auth::user()->city_id)->first(); // Assuming there is only one delivery charge
    }

    // Method to load cart items and calculate the total
    public function loadCart()
    {
        $userId = auth()->id(); // Assuming the user is authenticated

        if ($this->buyNowProduct) {
            // If a product was bought directly, load it into the cart
            $this->cartItems = Cart::with('product', 'variation', 'size')
                ->where('user_id', $userId)
                ->where('product_id', $this->buyNowProduct['product_id'])
                ->where('product_variation_id', $this->buyNowProduct['product_variation_id'])
                ->where('size_id', $this->buyNowProduct['size_id'])
                ->get();
        } else {
            // Otherwise, load all the user's cart items
            $this->cartItems = Cart::with('product', 'variation', 'size')
                ->where('user_id', $userId)
                ->get();
        }

        // Calculate the total price and check if any item is out of stock
        $this->total = 0;
        $this->hasOutOfStockItems = false;

        // Calculate the total price
        $this->total = collect($this->cartItems)->sum(function ($item) {
            return $item->quantity * $item->product->price; // Assuming each product has a price
        });

        // dd($this->cartItems);

        foreach ($this->cartItems as $item) {

            if ($item->size) {
                // Use checkStock method to check if the product with the size is in stock
                $stock = $item->checkStock($item->product->id, $item->size->id);

                // Check if the stock is zero or the item is out of stock
                if (!$stock) {
                    $this->hasOutOfStockItems = true; // Set flag if item is out of stock
                    break; // Exit loop early if any item is out of stock
                }
            }
        }
        // dd($this->hasOutOfStockItems);
    }

    // Check if the product is in stock
    public function checkStock($item)
    {
        return !$item->checkStock($item->product->id, $item->size->id); // Returns true if out of stock
    }

    // Method to apply a coupon and adjust the total
    public function applyCoupon()
    {
        if ($this->couponCode == 'DISCOUNT10') {
            $this->total -= 10; // Apply discount (for example, 10)
        }
    }

    // Method to place the order
    public function placeOrder()
    {
        // Validate that user has agreed to terms and conditions
        if (!$this->isAgreed) {
            session()->flash('error', 'You must agree to the terms and conditions.');
            return;
        }

        // Check if any item is out of stock
        if ($this->hasOutOfStockItems) {
            session()->flash('error', 'One or more items in your cart are out of stock.');
            return;
        }

        // Store order data
        $order = Order::create([
            'user_id' => auth()->id(),
            'subtotal' => $this->total,
            'delivery_charge' => $this->deliveryCharge->charge,
            'discount' => 0, // Add discount if applied
            'total' => $this->total + $this->deliveryCharge->charge,
            'payment_method_id' => $this->paymentMethod,
            'comment' => $this->comment,
            'status' => 'pending', // You can update the status as needed
        ]);

        // Store order items
        foreach ($this->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'size_id' => $cartItem->size->id ?? null,
                'product_variation_id' => $cartItem->variation->id ?? null,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Dispatch event for Facebook Pixel tracking (Purchase)
        $this->dispatch('orderPlacedPixel', [
            'order_id' => $order->id,
            'total' => $order->total,
            'currency' => $this->settings['currency'], // Adjust currency if needed
            'products' => collect($this->cartItems)->map(function ($cartItem) {
                return [
                    'id' => $cartItem->product->id,
                    'name' => $cartItem->product->name,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                ];
            })->toArray(),
        ]);

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        // Redirect to order confirmation page (you can adjust the route as needed)
        return $this->redirect(route('order.confirmation', $order->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.checkout.index', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
            'paymentMethods' => PaymentMethod::all(), // Add more payment methods as needed
            'deliveryCharge' => $this->deliveryCharge, // Add more delivery charges as needed
        ]);
    }
}
