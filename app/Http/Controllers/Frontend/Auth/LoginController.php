<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            $redirectUrl = session()->pull('redirect_url', route('home'));
            return redirect()->to($redirectUrl);
        }
        return view('frontend.auth.login');    
    }
}
