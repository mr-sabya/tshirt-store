<div class="ec-vendor-dashboard-card">
    <div class="ec-vendor-card-header">
        <h5>Order History</h5>
        <div class="ec-header-btn">
            <a class="btn btn-lg btn-primary" href="{{ route('shop.index')}}" wire:navigate>Shop Now</a>
        </div>
    </div>
    <div class="ec-vendor-card-body">
        <div class="ec-vendor-card-table">
            <table class="table ec-table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Variation</th>
                        <th scope="col">Size</th>
                        <th scope="col">Date</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)


                    @foreach($order->orderItems as $item)
                    <tr>
                        <th scope="row"><span>{{ $order->order_id ?? $order->id }}</span></th>
                        <td>
                            @if($item->productVariation)
                            <img class="prod-img"
                                src="{{ url('storage/'. $item->productVariation['image']) ??  url('storage/'. $item->product->image) }}"
                                alt="product image">
                            @else
                            <img class="prod-img"
                                src="{{ url('storage/'. $item->product->image) }}"
                                alt="product image">
                            @endif
                        </td>
                        <td><span>{{ $item->product->name ?? 'N/A' }}</span></td>
                        <td>
                            <span class="d-flex align-items-center gap-2">
                                @if($item->productVariation)
                                <div style="height: 25px; width: 25px; border-radius: 50%; background: {{ $item->productVariation['color']['color'] }};"></div>
                                @else
                                <div style="height: 25px; width: 25px; border-radius: 50%; background: {{ $item->product->color['color'] }};"></div>
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="d-flex align-items-center gap-2">
                                @if($item->size)
                                <div style="height: 25px; width: 20px; background: #f7f7f7; display: flex; align-items: center; justify-content: center; font-weight: bold;">{{ $item->size['name'] }}</div>
                                @else
                                <div style="height: 25px; width: 20px; background: #f7f7f7; display: flex; align-items: center; justify-content: center; font-weight: bold;">N/A</div>
                                @endif
                            </span>
                        </td>
                        <td><span>{{ $order->created_at->format('d M Y') }}</span></td>
                        <td><span>৳ {{ number_format(($item->price * $item->quantity) + $order->delivery_charge, 2) }}</span></td>
                        <td><span>{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <span class="tbl-btn">
                                <a class="btn btn-lg btn-primary" href="{{ route('order.track', $order->order_id) }}" wire:navigate>View</a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>