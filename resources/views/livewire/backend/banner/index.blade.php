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
                    <h4>@if ($bannerId) Edit Banner @else Create Banner @endif</h4>
                </div>
                <div class="card-body">
                    <!-- Banner form (Create / Edit) -->
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" id="heading" wire:model="heading" required>
                            @error('heading') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="offer_text">Offer Text</label>
                            <input type="text" class="form-control" id="offer_text" wire:model="offer_text" required>
                            @error('offer_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="text">Text</label>
                            <textarea class="form-control" id="text" wire:model="text" required></textarea>
                            @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" wire:model="product_id" required>
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Banner Image</label>
                            <div class="image-preview">
                                @if ($imagePreview)
                                <img src="{{ $imagePreview }}" alt="Image Preview" style="height: 100%; width: auto;">
                                @endif
                            </div>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if ($bannerId) Update Banner @else Create Banner @endif
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
                    <h4>Banners List</h4>
                </div>
                <div class="card-body">
                    <!-- Search bar -->
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="search" placeholder="Search Banners..." />
                    </div>

                    <!-- Banners Table -->
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('heading')">Heading
                                            @if ($sortBy === 'heading')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Offer Text</th>
                                    <th>Product</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle"><img src="{{ url('uploads/', $banner->image) }}" style="width: 100px;" alt=""></td>
                                    <td class="align-middle">{{ $banner->heading }}</td>
                                    <td class="align-middle">{{ $banner->offer_text }}</td>
                                    <td class="align-middle">{{ $banner->product->name }}</td>
                                    <td class="align-middle">
                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $banner->id }})">Edit</button>
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $banner->id }})">Delete</button>
                                        <button class="btn btn-secondary btn-sm" wire:click="toggleDetails({{ $banner->id }})">
                                            @if ($detailsBannerId === $banner->id) Hide Details @else View Details @endif
                                        </button>
                                    </td>
                                </tr>

                                @if ($detailsBannerId === $banner->id)
                                <tr>
                                    <td colspan="4">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <h5>Banner Details</h5>
                                                <p><strong>Heading:</strong> {{ $banner->heading }}</p>
                                                <p><strong>Offer Text:</strong> {{ $banner->offer_text }}</p>
                                                <p><strong>Text:</strong> {{ $banner->text }}</p>
                                                <p><strong>Product:</strong> {{ $banner->product->name }}</p>
                                                <p><strong>Image:</strong></p>
                                                @if ($banner->image)
                                                <img src="{{ url('uploads/', $banner->image) }}" alt="Banner Image" style="height: 150px;">
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
                                    <td colspan="4" class="text-center">No banners found!!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $banners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>