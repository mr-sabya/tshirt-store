<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizationOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'customization_category_id',
        'image',
    ];


    public function customizationCategory()
    {
        return $this->belongsTo(CustomizationCategory::class);
    }
}
