<div class="row">
    <!-- Left Column: Form -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-white">{{ $isEditing ? 'Edit Category' : 'Add New Category' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>

                        <div class="image-preview" style="height: 120px; padding: 10px;">
                            @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" style="height: 100%; width: auto;">
                            @elseif ($image)
                            <img src="{{ asset('storage/' . $image) }}" style="height: 100%; width: auto;">
                            @endif
                        </div>
                        <input wire:model="newImage" type="file" class="form-control @error('newImage') is-invalid @enderror">
                        @error('newImage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $isEditing ? 'Update' : 'Save' }}
                    </button>
                    @if ($isEditing)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary ms-2">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Table -->
    <div class="col-md-8">
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-white">Customization Categories</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $cat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cat->name }}</td>
                            <td><img src="{{ $cat->image_url }}" width="60" class="rounded"></td>
                            <td>
                                <!-- options -->
                                <button wire:click="showOptions({{ $cat->id }})" class="btn btn-sm btn-primary">Options</button>
                                <button wire:click="showProductVariations({{ $cat->id }})" class="btn btn-sm btn-primary">Product Variation</button>
                                <button wire:click="edit({{ $cat->id }})" class="btn btn-sm btn-info">Edit</button>
                                <button wire:click="confirmDelete({{ $cat->id }})" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            </td>
                        </tr>
                        @if($selectedCategory == $cat->id)
                        <tr>
                            <td colspan="4">
                                <livewire:backend.customization-category.options :categoryId="$cat->id" :key="$cat->id" />
                            </td>
                        </tr>
                        @endif
                        @if($selectedCategoryForVariation == $cat->id)
                        <tr>
                            <td colspan="4">
                                <livewire:backend.customization-category.product-options :categoryId="$cat->id" :key="'product-' . $cat->id" />
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button wire:click="delete" type="button" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>