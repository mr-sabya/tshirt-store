<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="text-white m-0">{{ $isEdit ? 'Update' : 'Add New' }} Design</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Design Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control" wire:keyup="generateSlug" />
                        @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label fw-semibold">Slug</label>
                        <input type="text" id="slug" wire:model="slug" class="form-control" />
                        @error('slug')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload and Preview -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Image</label>

                        <div class="image-preview">
                            @if ($image)
                            <!-- Temporary Image URL for Preview -->
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid" style="max-height: 200px; object-fit: cover;" alt="Preview">
                            @elseif ($currentImage)
                            <!-- Current Image for Edit Mode -->
                            <img src="{{ url('storage/'. $currentImage) }}" class="img-fluid" style="max-height: 200px; object-fit: cover;" alt="Current Image">
                            @endif
                        </div>

                        <input type="file" id="image" wire:model="image" class="form-control" accept="image/*" />
                        @error('image')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary w-48">
                            <i class="ri-save-line"></i> {{ $isEdit ? 'Update' : 'Save' }}
                        </button>
                        <button type="button" class="btn btn-secondary w-48" wire:click="resetForm">
                            <i class="ri-arrow-go-back-line"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Design List Section -->
    <div class="col-md-8">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary">
                <h4 class="text-white mb-0">Design List</h4>
            </div>

            <div class="card-body">
                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" wire:model="search" class="form-control w-50" placeholder="Search Designs..." />
                </div>

                <!-- Card View -->
                <div class="row">
                    @forelse ($designs as $design)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-light">
                            <!-- Image Section -->
                            <img src="{{ url('storage/'. $design->image) }}" alt="{{ $design->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                            <!-- Card Content -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $design->name }}</h5>
                                <p class="card-text text-muted">Slug: {{ $design->slug }}</p>
                            </div>

                            <!-- Card Actions -->
                            <div class="card-footer d-flex justify-content-between">
                                <button wire:click="edit({{ $design->id }})" class="btn btn-primary btn-sm">
                                    <i class="ri-pencil-line"></i> Edit
                                </button>
                                <button wire:click="delete({{ $design->id }})" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="text-center">No designs found!</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination Section -->
                <div class="mt-3">
                    {{ $designs->links() }}
                </div>
            </div>
        </div>
    </div>

</div>