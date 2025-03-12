<div class="row">
    <!-- Left Column: Form -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $isEditing ? 'Edit FAQ' : 'Add New FAQ' }}
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control" wire:model="question">
                        @error('question') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control" wire:model="answer"></textarea>
                        @error('answer') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" wire:model="status">
                        <label class="form-check-label">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ $isEditing ? 'Update FAQ' : 'Save FAQ' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: FAQ Table -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-secondary text-white">FAQ List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $index => $faq)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>
                                <span class="badge {{ $faq->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faq->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" wire:click="edit({{ $faq->id }})">Edit</button>
                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $faq->id }})">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No FAQs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>