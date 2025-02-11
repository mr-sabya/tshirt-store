<div class="col-md-12">


    <div class="card border-0 shadow-lg rounded-4 mb-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
            style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <strong>🔖 Order ID: {{ $order->order_id ?? $order->id }}</strong>
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
                    <p class="mt-1"><strong>📍 Address:</strong> {{ $order->user->address }},
                        {{ $order->user->city->name ?? '-' }},
                        {{ $order->user->division->name ?? '-' }}
                    </p>
                </div>
                <div class="col text-end">
                    <p class="mb-1"><strong>👤 Customer:</strong> {{ $order->user->name }}</p>
                    <p class="mb-1"><strong>📞 Phone:</strong> {{ $order->user->phone }}</p>
                    <p class="mb-1"><strong>✉️ Email:</strong> {{ $order->user->email }}</p>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-sm border rounded-3 overflow-hidden">
                    <thead class="table-light">
                        <tr class="fw-semibold text-uppercase">
                            <th>#</th>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ url('storage', $item->productVariation['image']) }}"
                                    alt="Product Image" class="rounded-circle shadow-sm"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                                {{ $item->product->name }}
                            </td>
                            <td class="text-center">{{ $item->size['name'] ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div style="width: 18px; height: 18px; border-radius: 50%; background-color: {{ $item->productVariation['color']['color'] }};"></div>
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
                            <th class="text-end" colspan="6">Subtotal</th>
                            <th class="text-end">৳ {{ number_format($order->subtotal, 2) }}</th>
                        </tr>
                        <tr>
                            <th class="text-end" colspan="6">Delivery</th>
                            <th class="text-end">৳ {{ number_format($order->delivery_charge, 2) }}</th>
                        </tr>
                        <tr class="table-dark text-white">
                            <th class="text-end fw-bold" colspan="6">Grand Total</th>
                            <th class="text-end fw-bold">৳ {{ number_format($order->total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white pb-4">
            <h5 class="card-title">Update Order Status</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div class="button-group">
                    <!-- Processing Button -->
                    <button wire:click="updateStatus('processing')"
                        class="btn text-white {{ $order->status == 'processing' || $order->status == 'designing' || $order->status == 'printing' || $order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'cancelled' ? 'bg-secondary disabled' : 'bg-primary' }}">
                        Processing
                    </button>

                    <!-- Arrow or Line -->
                    <span class="mx-2">→</span>

                    <!-- Designing Button -->
                    <button wire:click="updateStatus('designing')"
                        class="btn text-white {{ $order->status == 'designing' || $order->status == 'printing' || $order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'cancelled' ? 'bg-secondary disabled' : 'bg-primary' }}">
                        Designing
                    </button>

                    <!-- Arrow or Line -->
                    <span class="mx-2">→</span>

                    <!-- Printing Button -->
                    <button wire:click="updateStatus('printing')"
                        class="btn text-white {{ $order->status == 'printing' || $order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'cancelled' ? 'bg-secondary disabled' : 'bg-primary' }}">
                        Printing
                    </button>

                    <!-- Arrow or Line -->
                    <span class="mx-2">→</span>

                    <!-- Shipped Button -->
                    <button wire:click="updateStatus('shipped')"
                        class="btn text-white {{ $order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'cancelled' ? 'bg-secondary disabled' : 'bg-primary' }}">
                        Shipped
                    </button>

                    <!-- Arrow or Line -->
                    <span class="mx-2">→</span>

                    <!-- Delivered Button -->
                    <button wire:click="updateStatus('delivered')"
                        class="btn text-white {{ $order->status == 'delivered' || $order->status == 'cancelled' ? 'bg-secondary disabled' : 'bg-primary' }}">
                        Delivered
                    </button>
                </div>

                <!-- Cancel Button -->
                <button wire:click="updateStatus('cancelled')"
                    class="btn bg-danger text-white">
                    Cancel
                </button>
            </div>
        </div>
    </div>


</div>