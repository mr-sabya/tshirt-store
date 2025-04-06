<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Banner as ModelsBanner;
use App\Models\ImageBanner;
use Livewire\Component;

class Banner extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.banner',[
            'banners' => ModelsBanner::orderBy('id', 'DESC')->get(),
            'image_banners' => ImageBanner::orderBy('id', 'DESC')->take(2)->get(),
        ]);
    }
}
