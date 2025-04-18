<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Testimonial as ModelsTestimonial;
use Livewire\Component;

class Testimonial extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.testimonial',[
            'testimonials' => ModelsTestimonial::all(),
        ]);
    }
}
