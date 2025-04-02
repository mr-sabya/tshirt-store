<section class="section order-confirmation-section ec-vendor-uploads section-space-p">
    <div class="container">
        <div class="ec-vendor-dashboard-card">
            <div class="ec-vendor-card-header">
                <h5>Invoice</h5>
                <div class="ec-header-btn">
                    <a class="btn btn-lg btn-secondary" href="#">Print</a>
                    <a class="btn btn-lg btn-primary" href="#">Export</a>
                </div>
            </div>
            <div class="ec-vendor-card-body padding-b-0">
                <div class="page-content">
                    <div class="page-header text-blue-d2">
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Site Logo" style="width: 150px;">
                    </div>

                    <div class="container px-0">
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <hr class="row brc-default-l1 mx-n1 mb-4" />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="my-2">
                                            <span class="text-sm text-grey-m2 align-middle">To : </span>
                                            <span class="text-600 text-110 text-blue align-middle">{{ $order->guest_name }}</span>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-2">{{ $order->user['address'] ?? $order->guest_address }}</div>
                                            <div class="my-2">{{ $order->city['name'] ?? 'N/A' }}</div>
                                            <div class="my-2"><b class="text-600">Phone : </b>{{ $order->guest_phone }}</div>
                                        </div>
                                    </div>

                                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                        <hr class="d-sm-none" />
                                        <div class="text-grey-m2">
                                            <div class="my-2"><span class="text-600 text-90">ID : </span> #{{ $order->order_id }}</div>
                                            <div class="my-2"><span class="text-600 text-90">Issue Date : </span> {{ $order->created_at->format('M d, Y') }}</div>
                                            <div class="my-2"><span class="text-600 text-90">Invoice No : </span> {{ $order->invoice_no }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="text-95 text-secondary-d3">
                                        <div class="ec-vendor-card-table">
                                            <table class="table ec-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->orderItems as $item)
                                                    <tr>
                                                        <th><span>{{ $loop->iteration }}</span></th>
                                                        <th>
                                                            @if($item->productVariation)
                                                            <img style="width: 50px;" src="{{ url('storage/'. $item->productVariation['image']) }}"></img>
                                                            @else
                                                            <img style="width: 50px;" src="{{ url('storage/'. $item->product['image']) }}"></img>
                                                            @endif

                                                        </th>
                                                        <td><span>{{ $item->product->name }}</span></td>
                                                        <td><span>{{ $item->size->name ?? 'N/A' }}</span></td>
                                                        <td><span>{{ $item->quantity }}</span></td>
                                                        <td><span>৳ {{ number_format($item->product->price, 2) }}</span></td>
                                                        <td><span>৳ {{ number_format($item->quantity * $item->product->price, 2) }}</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="border-none" colspan="5"><span></span></td>
                                                        <td class="border-color" colspan="1"><span><strong>Sub Total</strong></span></td>
                                                        <td class="border-color"><span><b>৳ {{ number_format($order->subtotal, 2) }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-none" colspan="5"><span></span></td>
                                                        <td class="border-color" colspan="1"><span><strong>Delivery Charge ({{ $order->delivery_charge }})</strong></span></td>
                                                        <td class="border-color"><span><b>৳ {{ number_format($order->delivery_charge, 2) }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-none m-m15" colspan="5"><span class="note-text-color">Extra note such as company or payment information...</span></td>
                                                        <td class="border-color m-m15" colspan="1"><span><strong>Total</strong></span></td>
                                                        <td class="border-color m-m15"><span><b>৳ {{ number_format($order->total + $order->delivery_charge, 2) }}</b></span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>