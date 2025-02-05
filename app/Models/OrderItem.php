<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'product_variation_id',
        'quantity',
        'price',
    ];

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with Size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // Relationship with ProductVariation
    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
