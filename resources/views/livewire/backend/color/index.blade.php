<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="row">
        <!-- Form Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $colorId ? 'Edit Color' : 'Create Color' }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="name">Color Name</label>
                            <input type="text" id="name" class="form-control" wire:model="name" wire:keyup="generateSlug" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control" wire:model="slug" required>
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="color">Color Code</label>
                            <input type="color" id="color" class="form-control" wire:model="color" placeholder="#000000" required>
                            @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ $colorId ? 'Update Color' : 'Create Color' }}
                        </button>
                        <button type="button" class="btn btn-secondary" wire:click="resetInputFields">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Colors List</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" wire:model="search" placeholder="Search Colors...">
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('name')">
                                            Name
                                            @if ($sortBy === 'name')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" wire:click.prevent="toggleSort('slug')">
                                            Slug
                                            @if ($sortBy === 'slug')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Color Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($colors as $color)
                                <tr>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->slug }}</td>
                                    <td><span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $color->color }}; border: 1px solid #000;"></span> {{ $color->color }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" wire:click="edit({{ $color->id }})">Edit</button>
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $color->id }})">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No colors found!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $colors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>