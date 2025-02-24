<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Specify the table name (if it's different from the plural of the model name)
    protected $table = 'wishlists';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'product_id',
        'product_variation_id',
        'size_id'
    ];

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship to ProductVariation
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    // Define the relationship to Size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
