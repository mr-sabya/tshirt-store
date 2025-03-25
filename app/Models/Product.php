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

    // // Define the many-to-many relationship with Size
    // public function sizes()
    // {
    //     return $this->belongsToMany(Size::class);
    // }

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


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')
            ->withPivot('is_stock', 'stock')
            ->withTimestamps();
    }

    public function infos()
    {
        return $this->hasMany(ProductInfo::class);
    }


    public function getSizeStock($sizeId)
    {
        // Check if the product exists
        if (!$this) {
            return false; // Product doesn't exist, return false
        }

        // Check if the product has the specified size
        $size = $this->sizes()->where('size_id', $sizeId)->first();

        // If the size is not found, return false
        if (!$size) {
            return false; // Size not found, return false
        }

        // Check if the size is in stock by checking the pivot table's `is_stock` field
        return $size->pivot->is_stock ? $size->pivot->stock : false;
    }


    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    // Get average rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    // Get total number of reviews
    public function reviewCount()
    {
        return $this->ratings()->count();
    }
}
