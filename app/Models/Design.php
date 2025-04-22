<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'design_category_id',
        'name',
        'slug',
        'image',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // design_category
    public function designCategory()
    {
        return $this->belongsTo(DesignCategory::class);
    }
}
