<?php

namespace App\Livewire\Frontend\Blog;

use App\Models\Blog;
use App\Models\Comment;  // Add the Comment model
use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public $blogId;
    public $blog;
    public $previousBlog;
    public $nextBlog;
    public $comments = [];
    public $commentContent;
    public $userName;
    public $userEmail;
    public $parentCommentId; // This is for reply functionality

    // Mount method to initialize the component
    public function mount($blogId)
    {
        $this->blogId = $blogId;
        $this->blog = Blog::find($this->blogId);

        // Fetching published comments
        $this->comments = $this->blog->comments()->where('is_published', 1)->latest()->get();

        $this->previousBlog = Blog::where('id', '<', $this->blog->id)->latest()->first();
        $this->nextBlog = Blog::where('id', '>', $this->blog->id)->oldest()->first();
    }

    // Render method to pass data to the view
    public function render()
    {
        return view('livewire.frontend.blog.show', [
            'products' => Product::latest()->take(5)->get(),
            'recentBlogs' => Blog::where('is_published', 1)->latest()->take(5)->get(),
        ]);
    }

    // Method to submit a new comment
    public function submitComment()
    {
        // Validate the comment input
        $this->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email',
            'commentContent' => 'required|string|max:1000',
        ]);

        // Create the comment
        Comment::create([
            'blog_id' => $this->blogId,
            'user_name' => $this->userName,
            'user_email' => $this->userEmail,
            'content' => $this->commentContent,
            'is_published' => true,  // Mark the comment as published
        ]);

        // Clear form fields
        $this->userName = '';
        $this->userEmail = '';
        $this->commentContent = '';

        // Refresh the comments list after submission
        $this->comments = $this->blog->comments()->where('is_published', 1)->latest()->get();

        session()->flash('message', 'Your comment has been submitted successfully!');
    }

    // Method to submit a reply to a comment
    public function submitReply()
    {
        $this->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email',
            'commentContent' => 'required|string|max:1000',
            'parentCommentId' => 'required|exists:comments,id',
        ]);

        // Create the reply as a new comment with the parent_id set
        Comment::create([
            'blog_id' => $this->blogId,
            'user_name' => $this->userName,
            'user_email' => $this->userEmail,
            'content' => $this->commentContent,
            'is_published' => true,  // Mark the reply as published
            'parent_id' => $this->parentCommentId, // Reference to the parent comment
        ]);

        // Clear form fields
        $this->userName = '';
        $this->userEmail = '';
        $this->commentContent = '';

        // Refresh the comments list
        $this->comments = $this->blog->comments()->where('is_published', 1)->latest()->get();

        session()->flash('message', 'Your reply has been submitted successfully!');
    }
}
