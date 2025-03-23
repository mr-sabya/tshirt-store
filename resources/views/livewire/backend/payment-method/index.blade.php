    <div class="row">
        <!-- Form Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 text-white">{{ $paymentMethodId ? 'Edit' : 'Create' }} Payment Method</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="savePaymentMethod">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea wire:model="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Bkash Number</label>
                            <input type="text" wire:model="bkash_number" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Bank Account Number</label>
                            <input type="text" wire:model="bank_account_number" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Third-Party Gateway Details</label>
                            <textarea wire:model="third_party_gateway_details" class="form-control"></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" id="is_active" wire:model="is_active" class="form-check-input">
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $paymentMethodId ? 'Update' : 'Save' }}</button>
                        <button type="button" wire:click="resetFields" class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="m-0 text-white">Payment Methods</h5>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentMethods as $method)
                            <tr>
                                <td>{{ $method->name }}</td>
                                <td>{{ $method->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" wire:click="edit({{ $method->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $method->id }})" onclick="return confirm('Are you sure?')">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No Payment Methods Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>