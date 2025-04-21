<?php

namespace App\Livewire\Backend\Blog;

use App\Models\Blog;
use App\Models\Comment as ModelsComment;
use Livewire\Component;

class Comment extends Component
{
    public $blogId;
    public $comments;

    // To handle the approval and replying functionality
    public $selectedCommentId;
    public $replyContent;

    public function mount($blogId)
    {
        $this->blogId = $blogId;
        $this->loadComments();
    }

    public function loadComments()
    {
        // Load comments that are associated with the blog and not yet approved (or approved)
        $this->comments = ModelsComment::where('blog_id', $this->blogId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function approveComment($commentId)
    {
        $comment = ModelsComment::findOrFail($commentId);
        $comment->is_approved = true;
        $comment->save();

        session()->flash('message', 'Comment approved successfully!');
        $this->loadComments(); // Refresh the comment list
    }

    public function replyToComment()
    {
        $comment = ModelsComment::findOrFail($this->selectedCommentId);
        $comment->replies()->create([
            'content' => $this->replyContent,
            'user_id' => auth()->id(), // Store the admin user ID
        ]);

        session()->flash('message', 'Reply sent successfully!');
        $this->reset('replyContent'); // Clear the reply field
        $this->loadComments(); // Refresh the comment list
    }

    public function render()
    {
        return view('livewire.backend.blog.comment',[
            'blog' => Blog::find($this->blogId),
        ]);
    }
}
