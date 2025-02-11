<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('backend.order.index');
    }

    // show order
    public function show($orderId)
    {
        $order = Order::with('orderItems.product', 'user')->where('id', $orderId)->firstOrFail();
        return view('backend.order.show', compact('order'));
    }
}
