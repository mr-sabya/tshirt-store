<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id', 'user_id', 'user_name', 'user_email', 'content', 'is_published', 'parent_id'
    ];

    // Relationship for replies (self-referencing)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relationship to get the parent comment (if this is a reply)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
