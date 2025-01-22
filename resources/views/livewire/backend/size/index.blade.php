<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="row">
        <!-- Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $sizeId ? 'Edit Size' : 'Create Size' }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" wire:model="name" wire:keyup="generateSlug">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control" wire:model="slug">
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="size">Size</label>
                            <input type="text" id="size" class="form-control" wire:model="size">
                            @error('size') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $sizeId ? 'Update' : 'Create' }}</button>
                        <button type="button" class="btn btn-secondary" wire:click="resetInputFields">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Sizes List</h4>
                </div>
                <div class="card-body">
                    <!-- Search Bar -->
                    <input type="text" class="form-control mb-3" placeholder="Search..." wire:model="search">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" wire:click.prevent="toggleSort('name')">Name
                                        @if ($sortBy === 'name')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="#" wire:click.prevent="toggleSort('slug')">Slug
                                        @if ($sortBy === 'slug')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sizes as $size)
                            <tr>
                                <td>{{ $size->name }}</td>
                                <td>{{ $size->slug }}</td>
                                <td>{{ $size->size }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" wire:click="edit({{ $size->id }})">Edit</button>
                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $size->id }})">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No sizes found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $sizes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>