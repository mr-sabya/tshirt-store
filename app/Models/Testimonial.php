<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'name',
        'position',
        'company_name',
        'review',
        'rating',
        'image',
    ];
}
