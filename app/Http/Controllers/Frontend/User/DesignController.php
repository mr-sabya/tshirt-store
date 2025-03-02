<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    //
    public function index()
    {
        return view('frontend.user.design.index');
    }
}
