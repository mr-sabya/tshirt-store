<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        return view('frontend.blog.index');
    }

    
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('frontend.blog.show', compact('blog'));
    }
}
