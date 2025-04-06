<?php

namespace App\Livewire\Frontend\Theme;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.frontend.theme.footer',[
            'categories' => Category::orderBy('id', 'ASC')->take(4)->get(),
        ]);
    }
}
