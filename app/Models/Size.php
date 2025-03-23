<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'size',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')
            ->withPivot('is_stock', 'stock')
            ->withTimestamps();
    }
}
