<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'tagline',
        'logo',
        'footer_logo',
        'favicon',
        'currency',
        'top_header_text',
        'footer_about',
        'email',
        'phone',
        'address',
        'newsletter_text',
        'copyright_text',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'tiktok',
        'thread',
        'meta_title',
        'meta_description',
        'meta_keywords',

        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'og_type',

    ];
}
