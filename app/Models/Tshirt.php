<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tshirt_category_id', // Foreign key
        'image',
        'is_active',
    ];

    // Relationship with TshirtCategory model
    public function category()
    {
        return $this->belongsTo(TshirtCategory::class, 'tshirt_category_id');
    }
}
