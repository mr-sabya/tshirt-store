<section class="ec-page-content section-space-p checkout_page ">
    <div class="container">
        <div class="row">
            <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                <div class="ec-cart-content">
                    <div class="ec-cart-inner">
                        <div class="row">
                            <div class="table-content cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th style="text-align: center;">Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($product)
                                        <tr>
                                            <td data-label="Product" class="ec-cart-pro-name">
                                                <a href="{{ route('product.show', $product->id) }}">
                                                    <div class="d-flex align-items-center">
                                                        @if($product->variation)
                                                        <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $product->variation->image ?? $product->image) }}" alt="" />
                                                        @else
                                                        <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $product->image) }}" alt="" />
                                                        @endif
                                                        <div>
                                                            <p class="m-0">{{ $product->name }}</p>

                                                            @if($product->size)
                                                            <p class="m-0 {{ $product->checkStock($product->id, $product->size->id) ? 'text-success' : 'text-danger' }}">
                                                                {{ $product->checkStock($product->id, $product->size->id) ? 'In Stock' : 'Out of Stock' }}
                                                            </p>
                                                            @else
                                                            <p class="m-0 {{ $product->is_stock ? 'text-success' : 'text-danger' }}">
                                                                {{ $product->is_stock ? 'In Stock' : 'Out of Stock' }}
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td data-label="Price" class="ec-cart-pro-price">
                                                <span class="amount">৳ {{ number_format($product->price, 2) }}</span>
                                            </td>

                                            <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                {{ $guestData['quantity'] }}
                                            </td>

                                            <td data-label="Total" class="ec-cart-pro-subtotal">
                                                ৳ {{ number_format($guestData['quantity'] * $product->price, 2) }}
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <p>No Products Found!!</p>
                                                <div class="ec-cart-update-bottom p-0 align-items-center">
                                                    <a href="{{ route('shop.index') }}" class="w-100" wire:navigate>Go to Shop</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <h5>Shipping Details</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="guestName">Name</label>
                                <input type="text" placeholder="Name" class="form-control" id="guestName" wire:model="guestName">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="guestPhone">Phone Number</label>
                                <input type="text" placeholder="Phone" id="guestPhone" class="form-control" wire:model="guestPhone">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="division">Division</label>
                                <div class="select-box">
                                    <select wire:model="division_id" wire:change="getCity()" id="division" class="form-control">
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <div class="select-box">
                                    <select wire:model="city_id" id="city" wire:change="getDeliveryCharge" class="form-control">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>



                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="guestAddress">Adress</label>
                                <textarea type="text" placeholder="Address" id="guestAddress" class="form-control mt-2" wire:model="guestAddress"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ec-cart-rightside col-lg-4 col-md-12">
                <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Summary</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <div class="ec-cart-summary-bottom">
                                <div class="ec-cart-summary">
                                    <div>
                                        <span class="text-left">Sub-Total</span>
                                        <span class="text-right">৳ {{ number_format($total, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Delivery Charges</span>

                                        <span class="text-right">৳ {{ $deliveryCharge }}</span>

                                    </div>
                                    <!-- <div>
                                        <span class="text-left">Coupon Discount</span>
                                        <span class="text-right">
                                            <a class="ec-cart-coupan" >Apply Coupon</a>
                                        </span>
                                    </div>
                                    <div class="ec-cart-coupan-content">
                                        <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post" action="#">
                                            <input class="ec-coupan" type="text" placeholder="Enter Your Coupon Code" >
                                            <button class="ec-coupan-btn button btn-primary" type="submit">Apply</button>
                                        </form>
                                    </div> -->
                                    <div class="ec-cart-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">৳ {{ number_format($total + $deliveryCharge, 2) }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                    <div class="ec-sidebar-block">
                        <h3 class="ec-sidebar-title">Payment Method</h3>
                        @foreach($paymentMethods as $method)
                        <div class="radio-button mb-3">
                            <input type="radio" id="pay{{ $loop->index }}" name="payment" value="{{ $method->id }}" wire:model="paymentMethod">
                            <label for="pay{{ $loop->index }}">{{ $method->name }}</label>
                        </div>
                        @endforeach
                        
                        <textarea name="comment" placeholder="Comments" class="form-control mt-2" wire:model="comment"></textarea>
                        <span class="ec-pay-agree">
                            <input type="checkbox" id="isAgree" value="" wire:model="isAgreed">
                            <label class="ml-5 w-100" for="isAgree">I have read and agree to the <a href="#" style="display: contents; margin: 0;"><span>Terms &amp; Conditions</span></a></label>
                            <span class="checked mt-1"></span>
                        </span>
                        <button class="btn btn-primary w-100 mt-3" wire:click="placeOrder">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('livewire:init', function() {
        Livewire.on('orderPlacedPixel', (data) => {
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Purchase', {
                    value: data.total,
                    currency: data.currency,
                    contents: data.products.map(product => ({
                        id: product.id,
                        name: product.name,
                        quantity: product.quantity,
                        price: product.price
                    })),
                    content_type: 'product'
                });
                console.log("Facebook Pixel Purchase event fired", data);
            }
        });
    });
</script>