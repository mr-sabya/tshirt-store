<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Product List</h4>
            <a href="{{ route('admin.product.create') }}" wire:navigate class="btn btn-primary">Add Product</a>
        </div>

        <div class="card-body">
            <div class="form-group mb-3">
                <input type="text" class="form-control" wire:model="search" placeholder="Search Products...">
            </div>

            <table class="table">
                <thead>
                    <tr>
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
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No products found!</td>
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