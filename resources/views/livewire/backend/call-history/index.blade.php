<div class="row">
    <!-- Form Section -->
    @if ($isAssignedUser)
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="text-white m-0">{{ $callHistoryId ? 'Update' : 'Add New' }} Call History</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="storeOrUpdate">
                    <div class="mb-3">
                        <label for="feedback" class="form-label fw-semibold">Feedback</label>
                        <textarea id="feedback" wire:model="feedback" class="form-control"></textarea>
                        @error('feedback')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="call_time" class="form-label fw-semibold">Call Time</label>
                        <input type="datetime-local" id="call_time" wire:model="call_time" class="form-control" />
                        @error('call_time')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary w-48">
                            <i class="ri-save-line"></i> {{ $callHistoryId ? 'Update' : 'Save' }}
                        </button>
                        <button type="button" class="btn btn-secondary w-48" wire:click="resetForm">
                            <i class="ri-arrow-go-back-line"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Call History List Section -->
    <div class="col-md-8">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary">
                <h4 class="text-white mb-0">Call History for Lead: {{ $lead->name }}</h4>
            </div>

            <div class="card-body">
                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" wire:model="search" class="form-control w-50" placeholder="Search Call Histories..." />
                </div>

                <!-- Call History Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Feedback</th>
                                <th>Call Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($callHistories as $callHistory)
                            <tr>
                                <td>{{ $callHistory->user->name }}</td>
                                <td>{{ $callHistory->feedback }}</td>
                                <td>{{ $callHistory->call_time }}</td>
                                <td>
                                    @if ($isAssignedUser) <!-- Show edit and delete only for the assigned user -->
                                    <button wire:click="edit({{ $callHistory->id }})" class="btn btn-primary btn-sm">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $callHistory->id }})" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                    @else
                                    <span>Only assigned user can edit</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No call history found for this lead!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="mt-3">
                    {{ $callHistories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>