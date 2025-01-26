<?php

namespace App\Http\Controllers\Frontend\TshirtMaker;

use App\Http\Controllers\Controller;
use App\Models\Tshirt;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function index()
    {
        return response()->json(Tshirt::where('is_active', true)->get());
    }
}
