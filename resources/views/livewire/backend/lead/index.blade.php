<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="text-white m-0">{{ $isEdit ? 'Update' : 'Add New' }} Lead</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control" />
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" wire:model="email" class="form-control" />
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone Input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Phone</label>
                        <input type="text" id="phone" wire:model="phone" class="form-control" />
                        @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Source Input -->
                    <div class="mb-3">
                        <label for="source" class="form-label fw-semibold">Source</label>
                        <input type="text" id="source" wire:model="source" class="form-control" />
                        @error('source') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status Input -->
                    <div class="mb-3">
                        <label for="lead_status" class="form-label fw-semibold">Status</label>
                        <input type="text" id="lead_status" wire:model="status" class="form-control" />
                        @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Notes Input -->
                    <div class="mb-3">
                        <label for="notes" class="form-label fw-semibold">Notes</label>
                        <textarea id="notes" wire:model="notes" class="form-control"></textarea>
                        @error('notes') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Assigned To Input -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label fw-semibold">Assigned To</label>
                        <select id="assigned_to" wire:model="assigned_to" class="form-control">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Converted At Input -->
                    <div class="mb-3">
                        <label for="converted_at" class="form-label fw-semibold">Converted At</label>
                        <input type="date" id="converted_at" wire:model="converted_at" class="form-control" />
                        @error('converted_at') <span class="text-danger small">{{ $message }}</span> @enderror
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

    <!-- Lead List Section -->
    <div class="col-md-8">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary">
                <h4 class="text-white mb-0">Lead List</h4>
            </div>

            <div class="card-body">
                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" wire:model="search" class="form-control w-50" placeholder="Search Leads..." />
                </div>

                <!-- Lead Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Assigned To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leads as $lead)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->status }}</td>
                                <td>{{ $lead->assignedTo->name ?? 'N/A' }}</td>
                                <td>
                                    <button wire:click="edit({{ $lead->id }})" class="btn btn-primary btn-sm">
                                        <i class="ri-pencil-line"></i> Edit
                                    </button>
                                    <button wire:click="delete({{ $lead->id }})" class="btn btn-danger btn-sm">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                    <a href="{{ route('admin.call-history.index', $lead->id) }}" wire:navigate class="btn btn-primary btn-sm">
                                    <i class="ri-chat-history-line"></i> Call History
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No leads found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="mt-3">
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>