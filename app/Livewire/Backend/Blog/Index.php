<?php

namespace App\Livewire\Backend\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $updatesQueryString = ['search', 'sortField', 'sortDirection', 'page'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function duplicate($id)
    {
        $blog = Blog::find($id);

        if ($blog) {
            $newBlog = $blog->replicate(); // Create a duplicate of the blog
            $newBlog->title = 'Copy of ' . $blog->title; // Modify title to indicate it's a duplicate
            $newBlog->slug = Str::slug('Copy of ' . $blog->title); // Modify slug
            $newBlog->save(); // Save the new blog

            session()->flash('success', 'Blog duplicated successfully!');
        }
    }


    public function render()
    {
        $blogs = Blog::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.backend.blog.index', [
            'blogs' => $blogs,
        ]);
    }
}
