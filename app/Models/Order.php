<?php

namespace App\Models;

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
}
