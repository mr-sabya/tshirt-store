<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('frontend.user.profile.index');
        }

        return redirect()->route('login');
    }
}
