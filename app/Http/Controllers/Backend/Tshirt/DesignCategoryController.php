<?php

namespace App\Http\Controllers\Backend\Tshirt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignCategoryController extends Controller
{
    //
    public function index()
    {
        return view('backend.tshirt.design-category.index');
    }
}
