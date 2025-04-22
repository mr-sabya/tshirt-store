<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomizationCategory;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    //
    public function index($name)
    {
        $category = CustomizationCategory::where('name', $name)->first();
        return view('frontend.custom-order.index', compact('category'));
    }
}
