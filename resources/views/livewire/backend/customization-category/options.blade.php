<div>

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form to Add/Edit Customization Option -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @if ($isEditing)
                    <h4>Edit Customization Option</h4>
                    @else
                    <h4>Create Customization Option</h4>
                    @endif
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Option Name</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" wire:model="price">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" wire:model="newImage">
                            @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" width="100" class="mt-2">
                            @elseif ($image)
                            <img src="{{ asset('storage/' . $image) }}" width="100" class="mt-2">
                            @endif
                            @error('newImage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Update' : 'Create' }}</button>
                        @if ($isEditing)
                        <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancel</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Customization Options Table -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Customization Options List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($options as $option)
                            <tr>
                                <td>{{ $option->name }}</td>
                                <td>{{ $option->price ? '$' . number_format($option->price, 2) : 'Free' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $option->id }})">Edit</button>
                                    <button class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $option->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Customization Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customization option?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>