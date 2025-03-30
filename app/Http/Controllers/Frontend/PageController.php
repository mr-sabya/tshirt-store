<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // about page
    public function aboutPage()
    {
        $page = Page::where('slug', 'about-us')->first();
        return view('frontend.pages.about', compact('page'));
    }

    // faq page
    public function faqPage()
    {
        $page = Page::where('slug', 'faq')->first();
        return view('frontend.pages.faq', compact('page'));
    }

    // contact page
    public function contactPage()
    {
        $page = Page::where('slug', 'contact-us')->first();
        return view('frontend.pages.contact', compact('page'));
    }

    // privacy & policy
    public function privacyPage()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        return view('frontend.pages.privacy', compact('page'));
    }
    
    // terms & conditions
    public function termsPage()
    {
        return view('frontend.pages.terms');
    }
    // refund policy
    public function refundPage()
    {
        $page = Page::where('slug', 'refund-policy')->first();
        return view('frontend.pages.refund-privacy', compact('page'));
    }
}
