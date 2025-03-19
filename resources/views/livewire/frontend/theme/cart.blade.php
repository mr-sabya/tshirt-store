<div id="ec-side-cart" class="ec-side-cart" wire:ignore.self>
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">My Cart</span>
                <button class="ec-close">×</button>
            </div>
            <ul class="eccart-pro-items">
                @forelse ($cartItems as $index => $cart)
                <li>
                    <a href="#" class="sidekka_pro_img">
                        @if ($cart->variation)
                        <img src="{{ url('storage/'. $cart->variation['image']) }}" alt="product">
                        @else
                        <img src="{{ url('storage/'. $cart->product['image']) }}" alt="product">
                        @endif
                    </a>
                    <div class="ec-pro-content">
                        <a href="#" class="cart_pro_title">{{ $cart->product->name }}</a>
                        <span class="cart-price">
                            <span>৳{{ number_format($cart->product->price, 2) }}</span> x {{ $cart->quantity }}
                        </span>
                        <div class="qty-plus-minus">
                            <button type="button" class="dec ec_qtybtn" wire:click="decreaseQuantity({{ $cart->id }})">-</button>
                            <input class="qty-input" type="text" value="{{ $cart->quantity }}" />
                            <button type="button" class="inc ec_qtybtn" wire:click="increaseQuantity({{ $cart->id }})">+</button>
                        </div>
                        <a href="javascript:void(0)" wire:click="removeItem({{ $cart->id }})" class="remove">×</a>
                    </div>
                </li>
                @empty
                <li>
                    <div class="empty-cart">
                        <img src="{{ url('assets/frontend/images/11329060.png') }}" alt="">
                        <p>No items found in your cart!!</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Sub-Total :</td>
                            <td class="text-right">৳ {{ number_format($cartItems->sum(fn($cart) => $cart->quantity * $cart->product->price), 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">VAT (0%) :</td>
                            <td class="text-right">৳ 0.00</td>
                        </tr>
                        <tr>
                            <td class="text-left">Total :</td>
                            <td class="text-right primary-color">
                                ৳ {{ number_format($cartItems->sum(fn($cart) => $cart->quantity * $cart->product->price), 2) }}
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{ route('user.cart') }}" wire:navigate class="btn btn-primary">View Cart</a>
                <a href="{{ route('user.checkout') }}" wire:navigate class="btn btn-secondary">Checkout</a>
            </div>
        </div>
    </div>
</div>