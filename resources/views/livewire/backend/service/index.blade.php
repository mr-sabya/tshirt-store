<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                {{ $updateMode ? 'Edit Service' : 'Add Service' }}
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome Class)</label>
                        <input type="text" class="form-control" wire:model="icon" placeholder="e.g. fa-solid fa-star">
                        @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" wire:model="title">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Text</label>
                        <textarea class="form-control" wire:model="text"></textarea>
                        @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Save' }}</button>
                    @if($updateMode)
                    <button type="button" class="btn btn-secondary" wire:click="resetFields">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <span>Service List</span>
                <input type="text" class="form-control w-25" wire:model="search" placeholder="Search...">
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th wire:click="sortBy('icon')" style="cursor: pointer;">Icon</th>
                            <th wire:click="sortBy('title')" style="cursor: pointer;">Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr>
                            <td><i class="{{ $service->icon }}"></i></td>
                            <td>{{ $service->title }}</td>
                            <td>{{ Str::limit($service->text, 40) }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $service->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $service->id }})" onclick="return confirm('Are you sure?')">Delete</button>
                            </td>
                        </tr>
                        @endforeach

                        @if($services->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No services found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>