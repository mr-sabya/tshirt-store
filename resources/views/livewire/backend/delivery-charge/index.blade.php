<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 text-white">{{ $deliveryChargeId ? 'Edit' : 'Add' }} Delivery Charge</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveDeliveryCharge">
                    <div class="mb-3">
                        <label for="city_id" class="form-label">City</label>
                        <select wire:model="city_id" class="form-control">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="charge" class="form-label">Charge</label>
                        <input type="number" step="0.01" wire:model="charge" class="form-control">
                        @error('charge') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $deliveryChargeId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" wire:click="resetFields" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="m-0 text-white">Delivery Charges</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>Charge</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveryCharges as $index => $charge)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $charge->city->name }}</td>
                            <td>{{ $charge->charge }}</td>
                            <td>
                                <button wire:click="edit({{ $charge->id }})" class="btn btn-sm btn-warning">Edit</button>
                                <button wire:click="delete({{ $charge->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>