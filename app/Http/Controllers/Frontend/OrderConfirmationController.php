<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    /**
     * Show the order confirmation page with order details.
     *
     * @param  int  $orderId
     * @return \Illuminate\View\View
     */
    public function show($orderId)
    {
        // Fetch the order from the database
        $order = Order::with('orderItems.product', 'orderItems.size', 'orderItems.productVariation')
            ->where('id', $orderId)
            ->firstOrFail();

        // Return the confirmation view with order data
        return view('frontend.order.confirmation', [
            'order' => $order
        ]);
    }
}
