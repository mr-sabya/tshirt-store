<section class="ec-page-content section-space-p checkout_page ">
    <div class="container">
        <div class="row">
            <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                <!-- cart content Start -->
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
                                        @forelse($cartItems as $item)
                                        <tr>
                                            <td data-label="Product" class="ec-cart-pro-name">
                                                <a href="{{ route('product.show', $item->product->id) }}">
                                                    @if($item->variation)
                                                    <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $item->variation->image ?? $item->product->image) }}" alt="" />
                                                    @else
                                                    <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $item->product->image) }}" alt="" />
                                                    @endif
                                                    {{ $item->product->name }}
                                                </a>
                                            </td>
                                            <td data-label="Price" class="ec-cart-pro-price">
                                                <span class="amount">৳ {{ $item->product->price }}</span>
                                            </td>


                                            <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                {{ $item->quantity }}
                                            </td>



                                            <td data-label="Total" class="ec-cart-pro-subtotal">
                                                ৳ {{ number_format($item->quantity * $item->product->price, 2) }}
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <p>No Products Found!!</p>
                                                <div class="ec-cart-update-bottom p-0 align-items-center">
                                                    <a href="{{ route('shop.index')}}" class="w-100" wire:navigate>Go to Shop</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ec-cart-update-bottom">
                                        <a href="#">Go to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--cart content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="ec-cart-rightside col-lg-4 col-md-12">
                <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                    <!-- Sidebar Summary Block -->
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
                                        <span class="text-right">৳ 10.00</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Coupon Discount</span>
                                        <span class="text-right">
                                            <a class="ec-cart-coupan" wire:click.prevent="applyCoupon">Apply Coupon</a>
                                        </span>
                                    </div>
                                    <div class="ec-cart-coupan-content">
                                        <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post" action="#">
                                            <input class="ec-coupan" type="text" placeholder="Enter Your Coupon Code" wire:model="couponCode">
                                            <button class="ec-coupan-btn button btn-primary" type="submit">Apply</button>
                                        </form>
                                    </div>
                                    <div class="ec-cart-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">৳ {{ number_format($total + 10, 2) }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Sidebar Summary Block -->
                </div>

                <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                    <!-- Sidebar Payment Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Payment Method<div class="ec-sidebar-res"><i class="ecicon eci-angle-down"></i></div>
                            </h3>
                        </div>
                        <div class="ec-sb-block-content ec-sidebar-dropdown">
                            <div class="ec-checkout-pay">
                                <div class="ec-pay-desc">Please select the preferred payment method to use on this
                                    order.</div>
                                <span class="ec-pay-option">
                                    <div class="radio-button mb-3">
                                        <input type="radio" id="pay1" name="payment" value="Cash On Delivery" wire:model="paymentMethod" checked>
                                        <label for="pay1">Cash On Delivery</label>
                                    </div>
                                </span>
                                <span class="ec-pay-option">
                                    <div class="radio-button mb-3">
                                        <input type="radio" id="pay2" name="payment" value="Bkash" wire:model="paymentMethod">
                                        <label for="pay2">Bkash</label>
                                    </div>
                                </span>
                                <span class="ec-pay-commemt">
                                    <span class="ec-pay-opt-head">Add Comments About Your Order</span>
                                    <textarea name="your-commemt" placeholder="Comments" wire:model="comment"></textarea>
                                </span>
                                <span class="ec-pay-agree">
                                    <input type="checkbox" id="isAgree" value="" wire:model="isAgreed">
                                    <label class="ml-5 w-100" for="isAgree">I have read and agree to the <a href="#" style="display: contents; margin: 0;"><span>Terms &amp; Conditions</span></a></label>
                                    <span class="checked mt-1"></span>
                                </span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary w-100" wire:click="placeOrder">Order Now</button>
                        </div>
                    </div>
                    <!-- Sidebar Payment Block -->
                </div>

                <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                    <!-- Sidebar Payment Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Payment Method<div class="ec-sidebar-res"><i class="ecicon eci-angle-down"></i></div>
                            </h3>
                        </div>
                        <div class="ec-sb-block-content ec-sidebar-dropdown">
                            <div class="ec-check-pay-img-inner">
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment1.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment2.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment3.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment4.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment5.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment6.png') }}" alt="">
                                </div>
                                <div class="ec-check-pay-img">
                                    <img src="{{ url('assets/frontend/images/icons/payment7.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Payment Block -->
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