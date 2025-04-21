<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'customization_category_id',  // Foreign key to CustomizationCategory
        'material',      // E.g., Cotton, Jersey, China Rim Mug
        'price',         // Price for this option
    ];

    // Relationship with CustomizationCategory
    public function customizationCategory()
    {
        return $this->belongsTo(CustomizationCategory::class);
    }
}
