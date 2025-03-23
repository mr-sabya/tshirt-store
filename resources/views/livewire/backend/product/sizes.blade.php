<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Add/Edit Product Size</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <select wire:model="size_id" class="form-select">
                            <option value="">Select Size</option>
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }} ({{ $size->size }})</option>
                            @endforeach
                        </select>
                        @error('size_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input wire:model="is_stock" class="form-check-input" type="checkbox" id="inStock">
                        <label class="form-check-label" for="inStock">In Stock</label>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input wire:model="stock" type="number" class="form-control">
                        @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $size_id ? 'Update' : 'Add' }}</button>
                    @if($updateMode)
                        <button type="button" class="btn btn-secondary" wire:click="cancel">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>Product Sizes</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>In Stock</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->sizes as $size)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $size->name }} ({{ $size->size }})</td>
                            <td>{{ $size->pivot->is_stock ? 'Yes' : 'No' }}</td>
                            <td>{{ $size->pivot->stock }}</td>
                            <td>
                                <button wire:click="edit({{ $size->id }})" class="btn btn-sm btn-info">Edit</button>
                                <button wire:click="delete({{ $size->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No product sizes found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>