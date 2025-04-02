<div>
    <!-- Search & Filter Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" class="form-control w-25 shadow-sm" placeholder="🔍 Search Orders..." wire:model.debounce.300ms="search">
        <div class="btn-group shadow-sm">
            <button class="btn btn-light border" wire:click="filterByStatus('')">All</button>
            <button class="btn btn-warning text-dark border" wire:click="filterByStatus('pending')">Pending</button>
            <button class="btn btn-danger border" wire:click="filterByStatus('cancelled')">Cancelled</button>
            <button class="btn btn-success border" wire:click="filterByStatus('confirmed')">Confirmed</button>
        </div>
    </div>

    <!-- Orders List -->
    <div class="row">
        @forelse ($orders as $order)
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                    style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <strong>🔖 Order ID: {{ $order->order_id ?? $order->id }} {{ !$order->user_id ? '(Guest Order)' : '' }}</strong>
                    <span class="badge px-3 py-2 fw-bold shadow-sm 
                            {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-success') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <p class="mb-1"><strong>📄 Invoice:</strong> {{ $order->invoice_no }}</p>
                            <p class="mb-1"><strong>💰 Total:</strong> ৳ {{ number_format($order->total, 2) }}</p>
                            <p class="mt-1"><strong>📍 Address:</strong> {{ $order->user->address ?? $order->guest_address }},
                                {{ $order->user->city->name ?? $order->city['name'] ?? '-' }},
                                {{ $order->user->division->name ?? $order->division['name'] ?? '-' }}
                            </p>
                        </div>
                        <div class="col text-end">
                            <p class="mb-1"><strong>👤 Customer:</strong> {{ $order->user->name ?? $order->guest_name }}</p>
                            <p class="mb-1"><strong>📞 Phone:</strong> {{ $order->user->phone ?? $order->guest_phone }}</p>
                            <p class="mb-1"><strong>✉️ Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Show/Hide Order Items Button -->
                    <div class="text-center">
                        <button class="btn btn-outline-primary btn-sm w-100" wire:click="toggleOrder({{ $order->id }})">
                            {{ in_array($order->id, $expandedOrders) ? 'Hide Items ▲' : 'Show Items ▼' }}
                        </button>
                    </div>

                    <!-- Order Items Table (Hidden by Default) -->
                    @if(in_array($order->id, $expandedOrders))
                    <div class="table-responsive">
                        <table class="table table-sm border rounded-3 overflow-hidden">
                            <thead class="table-light">
                                <tr class="fw-semibold text-uppercase">
                                    <th>Product</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr class="align-middle">
                                    <td>
                                        @if($item->productVariation)
                                        <img src="{{ url('storage', $item->productVariation['image']) }}"
                                            alt="Product Image" class="rounded-circle shadow-sm"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                        <img src="{{ url('storage', $item->product['image']) }}"
                                            alt="Product Image" class="rounded-circle shadow-sm"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="text-center">{{ $item->size['name'] ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            @if($item->productVariation)
                                            <div style="width: 18px; height: 18px; border-radius: 50%; background-color: {{ $item->productVariation['color']['color'] }};"></div>
                                            @else
                                            <div style="width: 18px; height: 18px; border-radius: 50%; background-color: {{ $item->product['color']['color'] }};"></div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">৳ {{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">৳ {{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-end" colspan="5">Subtotal</th>
                                    <th class="text-end">৳ {{ number_format($order->subtotal, 2) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-end" colspan="5">Delivery</th>
                                    <th class="text-end">৳ {{ number_format($order->delivery_charge, 2) }}</th>
                                </tr>
                                <tr class="table-dark text-white">
                                    <th class="text-end fw-bold" colspan="5">Grand Total</th>
                                    <th class="text-end fw-bold">৳ {{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endif


                </div>

                <div class="card-footer text-end bg-white">
                    <a href="{{ route('admin.order.show', $order->id) }}" wire:navigate class="btn btn-primary btn-sm shadow-sm">📑 View Order</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center fw-bold">⚠️ No orders found.</div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>