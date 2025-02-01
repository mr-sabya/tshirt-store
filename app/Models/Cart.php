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
    public static function addItem($userId, $productId, $variationId, $sizeId, $quantity)
    {
        $cartItem = self::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->where('product_variation_id', $variationId)
                        ->where('size_id', $sizeId)
                        ->first();

        if ($cartItem) {
            // If the item already exists in the cart, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            // Otherwise, create a new cart item
            self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'product_variation_id' => $variationId,
                'size_id' => $sizeId,
                'quantity' => $quantity,
            ]);
        }
    }
}
