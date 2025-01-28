<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0">Product List</h4>
            <a href="{{ route('admin.product.create') }}" wire:navigate class="btn btn-primary">Add Product</a>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="form-group mb-3 w-50">
                    <input type="text" class="form-control" wire:model="search" placeholder="Search Products...">
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>
                            <a href="#" wire:click.prevent="toggleSort('name')">
                                Name
                                @if ($sortBy === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <th class="align-middle">{{ $loop->iteration }}</th>
                        <td class="align-middle"><img src="{{ url('storage/', $product->image) }}" alt="" style="width: 50px;"></td>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle">{{ $product->price }}</td>
                        <td class="align-middle">{{ $product->stock }}</td>
                        <td class="align-middle">{{ $product->status ? 'Active' : 'Inactive' }}</td>
                        <td class="align-middle">
                            <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})">Delete</button>
                            <button class="btn btn-secondary btn-sm" wire:click="toggleVariations({{ $product->id }})">
                                Show Variations
                            </button>
                        </td>
                    </tr>

                    @if ($product->id === $selectedProductId)
                    <tr>
                        <td colspan="7">
                            <livewire:backend.product.variations :productId="$product->id" />
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No products found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>