<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\City;
use App\Models\DeliveryCharge;
use App\Models\Division;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Guest extends Component
{
    public $cartItems = [];
    public $guestName, $guestPhone, $guestAddress, $division_id, $city_id;
    public $paymentMethod, $comment, $isAgreed = false;
    public $total = 0;
    public $product, $guestData, $settings, $divisions, $cities = [];
    public $deliveryCharge = 130;

    public function mount()
    {
        $this->settings = Setting::first();
        // Retrieve product from session if not logged in
        if (!auth()->check() && session()->has('buy_now_guest')) {
            $guestData = session('buy_now_guest');
            $this->guestData = $guestData;
            $product = Product::find($guestData['product_id']);

            if ($product) {
                $this->product = $product;

                $this->total = $this->product['price'];
            }
        }

        $this->divisions = Division::all();
    }


    // Method to fetch cities based on division
    public function getCity()
    {
        // Fetch cities based on selected division
        $this->cities = City::where('division_id', $this->division_id)->get();
    }

    public function getDeliveryCharge()
    {
        $deliveryCharge = DeliveryCharge::where('city_id', $this->city_id)->first();
        if ($deliveryCharge) {
            $this->deliveryCharge = $deliveryCharge->charge;
        } else {
            $this->deliveryCharge = 130;
        }
    }

    public function placeOrder()
    {
        // Validate input
        $this->validate([
            'guestName' => 'required',
            'guestPhone' => 'required',
            'guestAddress' => 'required',
            'division_id' => 'required',
            'city_id' => 'required',
            'paymentMethod' => 'required',
            'isAgreed' => 'accepted',
        ]);

        // Create the order for the guest
        $order = Order::create([
            'guest_name' => $this->guestName,
            'guest_phone' => $this->guestPhone,
            'guest_address' => $this->guestAddress,
            'division_id' => $this->division_id,
            'city_id' => $this->city_id,
            'subtotal' => $this->total,
            'total' => $this->total,
            'payment_method_id' => $this->paymentMethod,
            'status' => 'pending',
            'comment' => $this->comment,
            'delivery_charge' => $this->deliveryCharge,
        ]);

        // Create the order item for the single product
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,  // Single product from session
            'quantity' => session('buy_now_guest')['quantity'],  // Quantity from session
            'price' => $this->product->price,  // Price of the product
        ]);



        // Dispatch the order placed event (Optional)
        $this->dispatch('orderPlacedPixel', [
            'order_id' => $order->id,
            'total' => $this->total,
            'currency' => $this->settings['currency'], // Adjust currency if needed
            'products' => [
                [
                    'product_id' => $this->product->id,
                    'quantity' => session('buy_now_guest')['quantity'],
                    'price' => $this->product->price,
                ]
            ],
        ]);

        // Forget the session data after order is placed
        Session::forget('buy_now_guest');
        // Redirect to order confirmation page (you can adjust the route as needed)
        return $this->redirect(route('guest.order.confirmation', $order->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.checkout.guest', [
            'paymentMethods' => PaymentMethod::all(),
        ]);
    }
}
