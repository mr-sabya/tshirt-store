<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            @if($cartItems->count() > 0)
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                        <tr>
                                            <td data-label="Product" class="ec-cart-pro-name">
                                                <a href="{{ route('product.show', $item->product->id) }}">
                                                    <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $item->variation->image ?? $item->product->image) }}" alt="" />
                                                    {{ $item->product->name }}
                                                </a>
                                            </td>
                                            <td data-label="Price" class="ec-cart-pro-price">
                                                <span class="amount">৳ {{ $item->product->price }}</span>
                                            </td>


                                            <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                <div class="cart-qty-plus-minus">
                                                    <button type="button" class="dec" wire:click="decreaseQuantity({{ $item->id }})">-</button>
                                                    <input class="cart-plus-minus" type="text" value="{{ $item->quantity }}" />
                                                    <button type="button" class="inc" wire:click="increaseQuantity({{ $item->id }})">+</button>
                                                </div>
                                            </td>



                                            <td data-label="Total" class="ec-cart-pro-subtotal">
                                                ৳ {{ number_format($item->quantity * $item->product->price, 2) }}
                                            </td>
                                            <td data-label="Remove" class="ec-cart-pro-remove">
                                                <a href="#" wire:click.prevent="removeItem({{ $item->id }})">
                                                    <i class="ecicon eci-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ec-cart-update-bottom">
                                        <a href="#">Continue Shopping</a>
                                        <a href="{{ route('user.checkout') }}" wire:navigate class="btn btn-primary text-decoration-none text-white">Check Out</a>
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
                <div class="ec-sidebar-wrap">
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
                                        <span class="text-right"><a class="ec-cart-coupan">Apply Coupon</a></span>
                                    </div>
                                    <div class="ec-cart-coupan-content">
                                        <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post" action="#">
                                            <input class="ec-coupan" type="text" required="" placeholder="Enter Your Coupon Code" name="ec-coupan" value="">
                                            <button class="ec-coupan-btn button btn-primary" type="submit" name="subscribe" value="">Apply</button>
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
            </div>
            @else
            <div class="col-lg-12">
                <div class="ec-cart-inner empty-cart-page">
                    <img src="{{ url('assets/frontend/images/11329060.png') }}" alt="">
                    <p>No Items in your Cart</p>
                    <div class="ec-cart-update-bottom">
                        <a href="#">Continue Shopping</a>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>
</section>