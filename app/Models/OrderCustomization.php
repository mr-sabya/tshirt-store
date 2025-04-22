<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCustomization extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customization_category_id',
        'customization_option_id',
        'product_option_id',
        'design_id',
        'image',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
