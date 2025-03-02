<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index');
    }


    // show by id
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('backend.user.show', compact('user'));
    }
}
