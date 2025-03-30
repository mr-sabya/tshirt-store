<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Faq;
use App\Models\Page;
use Livewire\Component;

class FaqPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.faq-page',[
            'faqs' => Faq::where('status', 1)->get(),
            'page' => Page::where('slug', 'faq')->first()
        ]);
    }
}
