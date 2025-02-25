<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="row">
        <!-- Card for the form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>@if ($categoryId) Edit Category @else Create Category @endif</h4>
                </div>
                <div class="card-body">
                    <!-- Category form (Create / Edit) -->
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required wire:keyup="generateSlug">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" wire:model="slug" required>
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Category Image</label>
                            <div class="image-preview">
                                @if ($imagePreview)
                                <img src="{{ $imagePreview }}" alt="Image Preview" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input type="file" class="form-control" id="image" wire:model="image">

                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if ($categoryId) Update Category @else Create Category @endif
                        </button>
                        <button type="button" class="btn btn-secondary" wire:click="resetInputFields">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card for the table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Categories List</h4>
                </div>
                <div class="card-body">
                    <!-- Search bar -->
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="search" placeholder="Search Categories..." />
                    </div>

                    <!-- Categories Table -->
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('name')">Name
                                            @if ($sortBy === 'name')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('slug')">Slug
                                            @if ($sortBy === 'slug')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $category->id }})">Edit</button>
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $category->id }})">Delete</button>
                                        <button class="btn btn-secondary btn-sm" wire:click="toggleDetails({{ $category->id }})">
                                            @if ($detailsCategoryId === $category->id) Hide Details @else View Details @endif
                                        </button>
                                    </td>
                                </tr>

                                @if ($detailsCategoryId === $category->id)
                                <tr>
                                    <td colspan="3">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <h5>Category Details</h5>
                                                <p><strong>Category Name:</strong> {{ $category->name }}</p>
                                                <p><strong>Slug:</strong> {{ $category->slug }}</p>
                                                <p><strong>Image:</strong></p>
                                                @if ($category->image)
                                                <img src="{{ url('storage/'. $category->image) }}" alt="Category Image" style="height: 150px;">
                                                @else
                                                <p>No image uploaded.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No category found!!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>