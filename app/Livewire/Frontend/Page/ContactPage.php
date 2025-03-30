<?php

namespace App\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;

class ContactPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.page.contact-page',[
            'page' => $page = Page::where('slug', 'contact-us')->first()
        ]);
    }
}
