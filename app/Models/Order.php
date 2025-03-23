<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'invoice_no',
        'subtotal',
        'delivery_charge',
        'discount',
        'total',
        'payment_method_id',
        'comment',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate unique order ID if not provided
            if (!$order->order_id) {
                $order->order_id = 'ORD-' . strtoupper(Str::random(10));
            }

            // Generate unique invoice number if not provided
            if (!$order->invoice_no) {
                $order->invoice_no = 'INV-' . strtoupper(Str::random(8));
            }
        });

        static::created(function ($order) {
            // Step 1: Create Invoice for the order (now $order->id and $order->user_id exist)
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,  // Add user_id from the order
                'invoice_no' => $order->invoice_no, // Generate unique invoice number
                'amount' => $order->total,
                'status' => 'unpaid', // Initially set as unpaid
                'due_date' => Carbon::now()->addDays(30), // Due date is 30 days from now
                'paid_at' => null,  // Not yet paid
            ]);

            // Step 2: Automatically create Payment for the invoice
            Payment::create([
                'invoice_id' => $invoice->id,
                'user_id' => $order->user_id,  // Add user_id from the order
                'amount' => $order->total,  // Use the total amount from the order
                'payment_method_id' => $order->payment_method_id, // Payment method from order
                'transaction_id' => null, // Transaction ID is null initially
                'status' => 'pending', // Initial payment status
                'paid_at' => null,  // Not yet paid
            ]);
        });
    }



    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    // Order model
    public function latestStatus()
    {
        return $this->hasOne(OrderStatus::class)->latest();
    }

    // payment_method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
