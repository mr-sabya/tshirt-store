<?php

namespace App\Livewire\Frontend\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.category.index',[
            'categories' => Category::orderBy('id', 'ASC')->get(),
        ]);
    }
}
