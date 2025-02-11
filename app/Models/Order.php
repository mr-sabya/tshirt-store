<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'payment_method',
        'comment',
        'status',
    ];

    // Generate unique order ID and invoice number before saving
    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate unique order ID
            if (!$order->order_id) {
                $order->order_id = 'ORD-' . strtoupper(Str::random(10));
            }

            // Generate unique invoice number
            if (!$order->invoice_no) {
                $order->invoice_no = 'INV-' . strtoupper(Str::random(8));
            }

            // Step 1: Create Invoice for the order
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)), // Unique invoice number
                'total_amount' => $order->total,
                'status' => 'unpaid', // Initially set as unpaid
                'issued_at' => now(),
            ]);

            // Step 2: Automatically create Payment for the invoice
            Payment::create([
                'invoice_id' => $invoice->id,
                'payment_method' => $order->payment_method, // Payment method from order
                'amount_paid' => 0,  // Amount paid is initially 0 (if not paid at the time of order)
                'payment_status' => 'pending', // Initial payment status
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
}
