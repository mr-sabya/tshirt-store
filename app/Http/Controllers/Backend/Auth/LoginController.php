<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login()
    {
        if(auth()->check()) {
            return redirect()->route('admin.home');
        }
        return view('backend.auth.login');
    }
}
