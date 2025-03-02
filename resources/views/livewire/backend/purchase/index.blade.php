<div class="row">
    <!-- Left Column: Purchase Order Form -->
    <div class="col-md-4">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="m-0">{{ $selectedPurchaseOrderId ? 'Edit Purchase Order' : 'Add Purchase Order' }}</h4>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="storeOrUpdate">
                    <div class="form-group mb-3">
                        <label for="order_number">Order Number</label>
                        <input type="text" wire:model="order_number" class="form-control" id="order_number" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="supplier_id">Supplier</label>
                        <select wire:model="supplier_id" class="form-control" id="supplier_id" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_amount">Total Amount</label>
                        <input type="number" wire:model="total_amount" class="form-control" id="total_amount" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="order_status">Status</label>
                        <input type="text" wire:model="status" class="form-control" id="order_status" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="ordered_at">Ordered At</label>
                        <input type="date" wire:model="ordered_at" class="form-control" id="ordered_at" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="received_at">Received At</label>
                        <input type="date" wire:model="received_at" class="form-control" id="received_at">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $selectedPurchaseOrderId ? 'Update' : 'Add' }} Purchase Order</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Purchase Order Table -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Purchase Orders</h4>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <input type="text" wire:model="search" class="form-control w-25" placeholder="Search...">
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <a href="#" wire:click.prevent="sortByColumn('order_number')">
                                    Order Number
                                    @if ($sortBy === 'order_number')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->supplier->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="edit({{ $order->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="deletePurchaseOrder({{ $order->id }})">Delete</button>
                                @if ($selectedPurchaseOrderId)
                                <button class="btn btn-secondary btn-sm" wire:click="cancelSelection">Hide Items</button>
                                @else
                                <button class="btn btn-primary btn-sm" wire:click="showOrderItems({{ $order->id }})">Order Items</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $purchaseOrders->links() }}
            </div>
        </div>

        @if ($selectedPurchaseOrderId)
        <livewire:backend.purchase-item.index :purchaseOrderId="$selectedPurchaseOrderId" />
        @endif
    </div>
</div>