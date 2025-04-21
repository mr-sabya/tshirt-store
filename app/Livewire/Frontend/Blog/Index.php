<?php

namespace App\Livewire\Frontend\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        return view('livewire.frontend.blog.index', [
            'blogs' => Blog::where('is_published', 1)->latest()->paginate(10),
        ]);
    }
}
