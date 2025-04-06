<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    //
    public function index()
    {
        return view('frontend.compare.index');
    }
}
