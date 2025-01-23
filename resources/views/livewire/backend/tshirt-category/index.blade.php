<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 text-white">{{ $isEdit ? 'Update' : 'Add New' }} Category</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" wire:keyup="generateSlug" />
                        @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label fw-semibold">Slug</label>
                        <input type="text" id="slug" wire:model="slug" class="form-control @error('slug') is-invalid @enderror" />
                        @error('slug')
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

    <!-- Category List Section -->
    <div class="col-md-8">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary">
                <h4 class="text-white mb-0">Category List</h4>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <input type="text" wire:model="search" class="form-control w-50" placeholder="Search Categories..." />
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="#" wire:click.prevent="toggleSort('id')" class="text-decoration-none text-dark d-flex justify-content-between" aria-label="Sort by ID">
                                    <span>ID</span>
                                    @if ($sortBy === 'id')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="#" wire:click.prevent="toggleSort('name')" class="text-decoration-none text-dark d-flex justify-content-between" aria-label="Sort by Name">
                                    <span>Name</span>
                                    @if ($sortBy === 'name')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <button wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm">
                                    <i class="ri-pencil-line"></i> Edit
                                </button>
                                <button wire:click="delete({{ $category->id }})" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Section -->
                <div class="mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>