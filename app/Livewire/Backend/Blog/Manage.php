<?php

namespace App\Livewire\Backend\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Manage extends Component
{
    use WithFileUploads;

    public $slug, $blogs, $blogId, $title, $content, $meta_title, $meta_description, $meta_keywords, $og_title, $og_description, $is_published = false, $featured_image, $new_featured_image, $og_image, $new_og_image;

    public function mount($blogId = null)
    {
        if ($blogId) {
            $blog = Blog::findOrFail($blogId);
            $this->blogId = $blog->id;
            $this->title = $blog->title;
            $this->slug = $blog->slug;
            $this->content = $blog->content;
            $this->featured_image = $blog->featured_image;
            $this->meta_title = $blog->meta_title;
            $this->meta_description = $blog->meta_description;
            $this->meta_keywords = $blog->meta_keywords;
            $this->og_title = $blog->og_title;
            $this->og_description = $blog->og_description;
            $this->og_image = $blog->og_image;
            $this->is_published = $blog->is_published ? true : false;
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->blogId,
            'content' => 'required',
            'new_featured_image' => $this->blogId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'new_og_image' => 'nullable|image|max:2048',
        ]);

        $blog = $this->blogId ? Blog::findOrFail($this->blogId) : new Blog();

        if ($this->new_featured_image) {
            $blog->featured_image = $this->new_featured_image->store('blogs/featured', 'public');
        }

        if ($this->new_og_image) {
            $blog->og_image = $this->new_og_image->store('blogs/og', 'public');
        }

        $blog->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'is_published' => $this->is_published,
        ])->save();

        session()->flash('success', $this->blogId ? 'Blog updated!' : 'Blog created!');

        $this->resetForm();

        return $this->redirect(route('admin.blog.index'), navigate: true);
    }


    public function resetForm()
    {
        $this->reset([
            'blogId',
            'title',
            'slug',
            'content',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_title',
            'og_description',
            'is_published',
            'featured_image',
            'new_featured_image',
            'og_image',
            'new_og_image',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.blog.manage');
    }
}
