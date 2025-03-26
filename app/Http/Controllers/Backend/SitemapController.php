<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    //
    public function generateSitemap()
    {
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated successfully.']);
    }

    public function index()
    {
        return view('backend.sitemap.index');
    }
}
