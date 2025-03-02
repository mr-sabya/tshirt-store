<div class="row">

    <div class="col-lg-4">
        <!-- Order Item Form Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="m-0">Add / Update Order Item</h4>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="storeOrUpdate">
                    <div class="form-group mb-3">
                        <label for="product_id">Product</label>
                        <select wire:model="product_id" class="form-control" id="product_id" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" wire:model="quantity" class="form-control" id="quantity" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Unit Price</label>
                        <input type="number" wire:model="price" class="form-control" id="price" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if ($item_id) Update Order Item @else Add Order Item @endif
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Order Items Table Card -->
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">Order Items</h4>
            </div>

            <div class="card-body">
                <div class="form-group mb-3 w-50">
                    <input type="text" wire:model="search" class="form-control" placeholder="Search Order Items...">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <a href="#" wire:click.prevent="sortByColumn('id')">
                                    ID
                                    @if ($sortBy === 'id')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Product</th>
                            <th>
                                <a href="#" wire:click.prevent="sortByColumn('quantity')">
                                    Quantity
                                    @if ($sortBy === 'quantity')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="#" wire:click.prevent="sortByColumn('price')">
                                    Price
                                    @if ($sortBy === 'price')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="editItem({{ $item->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteItem({{ $item->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $orderItems->links() }}
                </div>
            </div>
        </div>
    </div>
</div>