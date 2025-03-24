<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 text-white">{{ $productInfoId ? 'Edit Product Info' : 'Add Product Info' }} ({{ $product->name }})</h5>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Key</label>
                    <input type="text" class="form-control" wire:model="key" placeholder="e.g., Color, Size">
                    @error('key') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Value</label>
                    <input type="text" class="form-control" wire:model="value" placeholder="e.g., Red, Large">
                    @error('value') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button class="btn btn-primary w-100" wire:click="save">
                    {{ $productInfoId ? 'Update' : 'Save' }}
                </button>

                @if($productInfoId)
                <button class="btn btn-secondary w-100 mt-2" wire:click="resetFields">
                    Cancel Edit
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 text-white">Product Info List for {{ $product->name }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productInfos as $index => $info)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $info->key }}</td>
                            <td>{{ $info->value }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="edit({{ $info->id }})">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $info->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($productInfos) == 0)
                        <tr>
                            <td colspan="4" class="text-center">No Product Info Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>