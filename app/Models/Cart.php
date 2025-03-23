<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'product_variation_id', 'size_id', 'quantity'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // Helper method to update or add a cart item
    // Helper method to update or add a cart item
    public static function addItem($userId, $productId, $productVariationId, $sizeId, $quantity)
    {
        // Build the query to check if the product already exists in the cart for the user
        $existingCartItem = self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where(function ($query) use ($productVariationId, $sizeId) {
                // If productVariationId is not null, check it
                if ($productVariationId !== null) {
                    $query->where('product_variation_id', $productVariationId);
                }

                // If sizeId is not null, check it
                if ($sizeId !== null) {
                    $query->where('size_id', $sizeId);
                }
            })
            ->first();

        if ($existingCartItem) {
            // If the product with the selected variation and size is already in the cart, update the quantity
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            // If the product is not in the cart, create a new entry
            self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'product_variation_id' => $productVariationId,
                'size_id' => $sizeId,
                'quantity' => $quantity,
            ]);
        }
    }


    // check item is in stock with size
    public static function checkStock($productId, $sizeId)
    {
        // Retrieve the product with its sizes
        $product = Product::find($productId);

        // Check if the product exists
        if (!$product) {
            return false; // Product doesn't exist, return false
        }

        // Check if the product has the specified size
        $size = $product->sizes()->where('size_id', $sizeId)->first();

        // If the size is not found, return false
        if (!$size) {
            return false; // Size not found, return false
        }

        // Check if the size is in stock by checking the pivot table's `is_stock` field
        if ($size->pivot->is_stock) {
            return $size->pivot->stock; // Return the stock quantity if in stock
        }

        // If not in stock, return false
        return false;
    }
}
