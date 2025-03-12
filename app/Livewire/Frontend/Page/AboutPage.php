<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.about-page',[
            'page' => Page::where('slug', 'about-us')->first()
        ]);
    }
}
