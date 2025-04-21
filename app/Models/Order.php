<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_phone',
        'guest_address',
        'division_id',
        'city_id',
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

    protected static function boot()
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
            // Step 1: Create Invoice for the order
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'guest_name' => $order->guest_name,
                'invoice_no' => $order->invoice_no,
                'amount' => $order->total,
                'status' => 'unpaid',
                'due_date' => Carbon::now()->addDays(30),
                'paid_at' => null,
            ]);

            // Step 2: Automatically create Payment for the invoice
            Payment::create([
                'invoice_id' => $invoice->id,
                'user_id' => $order->user_id,
                'guest_name' => $order->guest_name,
                'amount' => $order->total,
                'payment_method_id' => $order->payment_method_id,
                'transaction_id' => null,
                'status' => 'pending',
                'paid_at' => null,
            ]);
        });
    }

    // ✅ Relationship with User (Nullable)
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    // ✅ Relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customizations()
    {
        return $this->hasMany(OrderCustomization::class);
    }

    // ✅ Relationship with OrderStatus
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(OrderStatus::class)->latest();
    }

    // ✅ Payment Method Relationship
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // ✅ Division Relationship
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    // ✅ City Relationship
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
