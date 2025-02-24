<?php

namespace App\Http\Controllers\Frontend\TshirtMaker;

use App\Helpers\ImageHelper;
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

        if ($request->hasFile('uploadedDesign')) {
            $path = ImageHelper::uploadImage($request->file('uploadedDesign'), 'custom-designs');
        }

        return response()->json(['url' => asset('uploads/' . $path)]);
    }
}
