<div>
    <div class="card">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="m-0 text-white">Blog List</h4>
            <a href="{{ route('admin.blog.create') }}" wire:navigate class="btn btn-light">Add Blog</a>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="form-group mb-3 w-50">
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Search Blog...">
                </div>
            </div>


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th wire:click="sortBy('id')" style="cursor: pointer;">
                            ID
                            @if ($sortField === 'id')
                            <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                            @endif
                        </th>
                        <th>Image</th>
                        <th wire:click="sortBy('title')" style="cursor: pointer;">
                            Title
                            @if ($sortField === 'title')
                            <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                            @endif
                        </th>
                        <th>Published</th>
                        <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                            Created At
                            @if ($sortField === 'created_at')
                            <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>
                            @if ($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="" width="50">
                            @else
                            <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @if ($blog->is_published)
                            <span class="badge bg-success">Published</span>
                            @else
                            <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $blog->id) }}" wire:navigate class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No blogs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $blogs->links() }}
        </div>
    </div>
</div>
