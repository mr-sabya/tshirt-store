<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCustomization extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'position', 'image_path', 'notes'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
