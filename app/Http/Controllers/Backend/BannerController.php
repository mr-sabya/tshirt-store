<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('backend.banner.index');    
    }

    // image banner
    public function imageBanner()
    {
        return view('backend.banner.image-banner');
    }
}
