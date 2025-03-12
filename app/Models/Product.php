<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'regular_price',
        'buy_price',
        'cost_price',
        'is_stock',
        'stock',
        'category_id',
        'image',
        'details',
        'short_desc',
        'status',
        'featured',
        'discount',
        'supplier_id',
        'color_id',
    ];

    // Define the many-to-many relationship with Size
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with ProductVariation.
     * A product can have many variations.
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
