<?php

namespace App\Livewire\Backend\Page;

use App\Models\Page;
use Livewire\Component;

class Index extends Component
{
    public $pages;

    public function render()
    {
        $this->pages = Page::all();  // Retrieve all pages
        return view('livewire.backend.page.index');
    }
}
