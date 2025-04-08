<div class="card">
    <div class="card-header bg-primary">
        <div class="d-flex justify-content-between align-items-center ">
            <h4 class="m-0 text-white">Blog Comments</h4>
            <a href="{{ route('admin.blog.index') }}" wire:navigate class="btn btn-light">Back to Blogs</a>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card-body">

        <!-- blog title -->
        <h5 class="mb-3">Comments for: {{ $blog->title }}</h5>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->author_name }}</td>
                        <td>{{ $comment->created_at->format('F d, Y') }}</td>
                        <td>
                            @if (!$comment->is_published)
                            <button wire:click="approveComment({{ $comment->id }})" class="btn btn-success btn-sm">Approve</button>
                            @else
                            <span class="badge bg-success">Approved</span>
                            @endif

                            <button wire:click="$set('selectedCommentId', {{ $comment->id }})" data-bs-toggle="modal" data-bs-target="#replyModal" class="btn btn-primary btn-sm">Reply</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea wire:model="replyContent" class="form-control" placeholder="Enter your reply"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="replyToComment" class="btn btn-primary">Send Reply</button>
                </div>
            </div>
        </div>
    </div>
</div>