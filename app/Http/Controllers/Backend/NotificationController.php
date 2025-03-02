<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Show a specific notification by ID and redirect accordingly.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Fetch the notification by ID
        $notification = auth()->user()->notifications()->findOrFail($id);

        // Mark the notification as read
        $notification->markAsRead();

        // Check the type of notification and redirect
        switch ($notification->data['type']) {
            case 'order':
                // If it's an order notification, redirect to the order page
                $orderId = $notification->data['order_id'];
                return redirect()->route('admin.order.show', $orderId);

            case 'designer_application':
                // If it's a designer application, redirect to the user page
                $userId = $notification->data['user_id'];
                return redirect()->route('admin.user.show', $userId);

            default:
                // If the notification type is unknown, just redirect to a default page
                return redirect()->route('admin.dashboard');
        }
    }
}
