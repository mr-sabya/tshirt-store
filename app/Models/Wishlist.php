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

    // In Wishlist.php (Model)
    public static function addItem($userId, $productId, $productVariationId, $sizeId)
    {
        // Build the query to check if the product already exists in the wishlist for the user
        $query = self::where('user_id', $userId)
            ->where('product_id', $productId);

        // If productVariationId is not null, add it to the query
        if ($productVariationId !== null) {
            $query->where('product_variation_id', $productVariationId);
        }

        // If sizeId is not null, add it to the query
        if ($sizeId !== null) {
            $query->where('size_id', $sizeId);
        }

        // Execute the query to check for an existing wishlist item
        $existingWishlistItem = $query->first();

        if (!$existingWishlistItem) {
            // If the product with the selected variation and size is not in the wishlist, create a new entry
            self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'product_variation_id' => $productVariationId,
                'size_id' => $sizeId,
            ]);
        }

        if($existingWishlistItem){
            $existingWishlistItem->delete();
        }
    }


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
