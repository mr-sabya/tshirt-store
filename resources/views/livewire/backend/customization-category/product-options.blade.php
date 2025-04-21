<div>
    <!-- Success Message -->
    @if (session()->has('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-4">
        <!-- Form Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $isEditing ? 'Edit Product Option' : 'Add Product Option' }}</h5>

                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                        <div class="form-group">
                            <label for="material">Material</label>
                            <input type="text" id="material" class="form-control" wire:model="material" required>
                            @error('material') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" wire:model="price" required>
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">{{ $isEditing ? 'Update' : 'Save' }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Existing Product Options</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productOptions as $option)
                            <tr>
                                <td>{{ $option->material }}</td>
                                <td>{{ $option->price }}</td>
                                <td>
                                    <button wire:click="edit({{ $option->id }})" class="btn btn-info btn-sm">Edit</button>
                                    <button wire:click="confirmDelete({{ $option->id }})" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No product options available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product option?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>