<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // about page
    public function aboutPage()
    {
        return view('frontend.pages.about');    
    }

    // faq page
    public function faqPage()
    {
        return view('frontend.pages.faq');    
    }

    // contact page
    public function contactPage()
    {
        return view('frontend.pages.contact');    
    }

    // privacy & policy
    public function privacyPage()
    {
        return view('frontend.pages.privacy');    
    }

    // terms & conditions
    public function termsPage()
    {
        return view('frontend.pages.terms');    
    }
}
