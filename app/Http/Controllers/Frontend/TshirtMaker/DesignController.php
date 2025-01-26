<?php

namespace App\Http\Controllers\Frontend\TshirtMaker;

use App\Http\Controllers\Controller;
use App\Models\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{

    public function index()
    {
        return response()->json(Design::all());
    }

    public function upload(Request $request)
    {
        $request->validate(['uploadedDesign' => 'required|image|max:2048']);

        $path = $request->file('uploadedDesign')->store('designs', 'public');

        return response()->json(['url' => asset('storage/' . $path)]);
    }
}
