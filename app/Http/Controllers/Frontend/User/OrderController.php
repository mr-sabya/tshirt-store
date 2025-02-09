<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function track($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('frontend.user.order.track', compact('order'));
    }
}
