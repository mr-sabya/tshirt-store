<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $title, $addMargin;

    public function mount($title, $addMargin = null)
    {
        $this->title = $title;
        $this->addMargin = $addMargin;
    }


    public function render()
    {
        return view('livewire.frontend.components.breadcrumb');
    }
}
