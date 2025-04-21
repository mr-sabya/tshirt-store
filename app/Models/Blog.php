<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'is_published',
    ];

    // Auto-generate slug on creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }

    // URL for social sharing
    public function getUrlAttribute()
    {
        return url('/blog/' . $this->slug);
    }

    // Social Share Links
    public function shareLinks()
    {
        $url = urlencode($this->url);
        $title = urlencode($this->title);

        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'twitter' => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
            'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
            'whatsapp' => "https://api.whatsapp.com/send?text={$title}%20{$url}",
        ];
    }

    // comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
