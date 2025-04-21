<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Index method
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.blog.index');
    }

    // Create method
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    // Edit method
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blog.edit', compact('blog'));
    }


    // comments
    /**
     * Show the comments for the specified blog.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comments($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blog.comment', compact('blog'));
    }
}
