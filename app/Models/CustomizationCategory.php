<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    // Relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class, 'customization_category', 'name');
    }

    // Relationship with the CustomizationOption model
    public function options()
    {
        return $this->hasMany(CustomizationOption::class);
    }

    // Relationship with the ProductOption model (formerly ProductVariation)
    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    // Get the URL for the image (returns a default image if not set)
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default-category.png');
    }

    // Get the price for a specific position from the options
    public function getPriceForPosition($position): float
    {
        return $this->options()
            ->where('name', $position)
            ->value('price') ?? 0;
    }

    // Get the price for a specific product option (T-shirt, Mug, etc.)
    public function getPriceForProductOption($productType, $material): float
    {
        return $this->productOptions()
            ->where('product_type', $productType)
            ->where('material', $material)
            ->value('price') ?? 0;
    }
}
