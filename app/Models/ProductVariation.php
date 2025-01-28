<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'image'
    ];


    /**
     * Relationship with Product.
     * A variation belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship with Color.
     * A variation belongs to a color.
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
