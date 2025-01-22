<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.product.index');
    }

    public function create()
    {
        // Code to show the form to create a new product
        return view('backend.product.create');
    }

    public function edit($id)
    {
        // Code to show the form to edit an existing product
        $product = Product::findOrFail($id);
        return view('backend.product.edit', compact('product'));
    }
}
