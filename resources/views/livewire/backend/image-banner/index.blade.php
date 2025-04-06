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
                <div class="card-header bg-primary">
                    <h4 class="m-0 text-white">@if ($imageBannerId) Edit Image Banner @else Create Image Banner @endif</h4>
                </div>
                <div class="card-body">
                    <!-- Image Banner form (Create / Edit) -->
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" wire:model="title" required>
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="link">Link</label>
                            <input type="url" class="form-control" id="link" wire:model="link">
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alt_text">Alt Text</label>
                            <input type="text" class="form-control" id="alt_text" wire:model="alt_text">
                            @error('alt_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Banner Image</label>
                            <div class="image-preview">
                                @if ($imagePreview)
                                <img src="{{ $imagePreview }}" alt="Image Preview" style="height: 100%; width: auto;">
                                @elseif ($existingImage)
                                <img src="{{ asset('storage/' . $existingImage) }}" alt="Existing Image" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if ($imageBannerId) Update Image Banner @else Create Image Banner @endif
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
                <div class="card-header bg-primary">
                    <h4 class="m-0 text-white">Image Banners List</h4>
                </div>
                <div class="card-body">
                    <!-- Search bar -->
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="search" placeholder="Search Image Banners..." />
                    </div>

                    <!-- Image Banners Table -->
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('title')">Title
                                            @if ($sortBy === 'title')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($imageBanners as $imageBanner)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">
                                        @if ($imageBanner->image)
                                        <img src="{{ url('storage/'.$imageBanner->image) }}" style="width: 100px;" alt="{{ $imageBanner->alt_text }}">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $imageBanner->title }}</td>
                                    <td class="align-middle">{{ $imageBanner->link }}</td>
                                    <td class="align-middle">
                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $imageBanner->id }})">Edit</button>
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $imageBanner->id }})">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No image banners found!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $imageBanners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>