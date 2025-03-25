<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="m-0 text-white">{{ $testimonialId ? 'Edit Testimonial' : 'Add New Testimonial' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="submit" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" wire:model="position">
                        @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" wire:model="company_name">
                        @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="review">Review</label>
                        <textarea class="form-control" id="review" wire:model="review"></textarea>
                        @error('review') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="rating">Rating</label>
                        <input type="number" class="form-control" id="rating" wire:model="rating" min="1" max="5">
                        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="newImage">Image</label>
                        <input type="file" class="form-control" wire:model="image">
                        <div class="image-preview">
                            @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="preview" style="height: 100%; width: auto;">
                            @elseif($currentImage)
                            <img src="{{ asset('storage/' . $currentImage) }}" alt="current image" style="height: 100%; width: auto;">
                            @endif
                        </div>

                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="m-0 text-white">Testimonials</h5>
            </div>
            <div class="card-body">
                <input type="text" class="form-control mb-3 w-25" wire:model="searchTerm" placeholder="Search Testimonials...">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('name')" style="cursor: pointer;">Name</th>
                            <th wire:click="sortBy('position')" style="cursor: pointer;">Position</th>
                            <th wire:click="sortBy('company_name')" style="cursor: pointer;">Company</th>
                            <th wire:click="sortBy('rating')" style="cursor: pointer;">Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->position }}</td>
                            <td>{{ $testimonial->company_name }}</td>
                            <td>{{ $testimonial->rating }}</td>
                            <td>
                                <button wire:click="edit({{ $testimonial->id }})" class="btn btn-warning btn-sm">Edit</button>
                                <button wire:click="delete({{ $testimonial->id }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">No Testimonials Found!!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $testimonials->links() }}
                </div>
            </div>
        </div>
    </div>
</div>