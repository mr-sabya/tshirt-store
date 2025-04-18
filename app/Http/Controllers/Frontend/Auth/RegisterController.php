<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.register');    
    }
}
