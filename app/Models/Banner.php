<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heading',
        'offer_text',
        'text',
        'image',
        'product_id', // Assuming 'product_id' is the foreign key column name
    ];

    /**
     * Get the product associated with the banner.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
