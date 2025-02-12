<div class="row">
    <!-- Form Section -->
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="text-white m-0">{{ $isEdit ? 'Update' : 'Add New' }} Expense</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-semibold">Category</label>
                        <select id="category_id" wire:model="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Amount</label>
                        <input type="number" id="amount" wire:model="amount" class="form-control" />
                        @error('amount')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea id="description" wire:model="description" class="form-control"></textarea>
                        @error('description')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label fw-semibold">Date</label>
                        <input type="date" id="date" wire:model="date" class="form-control" />
                        @error('date')
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

    <!-- Expense List Section -->
    <div class="col-md-8">
        <div class="card shadow-sm border-light">
            <div class="card-header bg-primary">
                <h4 class="text-white mb-0">Expense List</h4>
            </div>

            <div class="card-body">
                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" wire:model="search" class="form-control w-50" placeholder="Search Expenses..." />
                </div>

                <!-- Expense Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->category->name }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>
                                    <button wire:click="edit({{ $expense->id }})" class="btn btn-primary btn-sm">
                                        <i class="ri-pencil-line"></i> Edit
                                    </button>
                                    <button wire:click="delete({{ $expense->id }})" class="btn btn-danger btn-sm">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No expenses found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="mt-3">
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>