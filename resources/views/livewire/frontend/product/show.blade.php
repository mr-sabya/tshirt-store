<!-- Sart Single product -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                <!-- Single product content Start -->
                <div class="single-pro-block">
                    <div class="single-pro-inner">
                        <div class="row">
                            <div class="single-pro-img single-pro-img-no-sidebar" wire:ignore>
                                <div class="single-product-scroll">
                                    <div class="single-product-cover">
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive" src="{{ url('storage', $product->image) }}"
                                                alt="">
                                        </div>
                                        @foreach($product->variations as $variation)
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive" src="{{ url('storage', $variation->image) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="single-nav-thumb">
                                        <div class="single-slide">
                                            <img class="img-responsive" src="{{ url('storage', $product->image) }}"
                                                alt="">
                                        </div>
                                        @foreach($product->variations as $variation)
                                        <div class="single-slide">
                                            <img class="img-responsive" src="{{ url('storage', $variation->image) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="single-pro-desc single-pro-desc-no-sidebar">
                                <div class="single-pro-content">
                                    <h5 class="ec-single-title">{{ $product->name }}</h5>
                                    <div class="ec-single-rating-wrap">
                                        <div class="ec-single-rating">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star-o"></i>
                                        </div>
                                        <span class="ec-read-review"><a href="#ec-spt-nav-review">Be the first to
                                                review this product</a></span>
                                    </div>
                                    <div class="ec-single-desc">{{ $product->short_desc }}</div>

                                    <div class="ec-single-price-stoke mt-4">
                                        <div class="ec-single-price">
                                            <span class="ec-single-ps-title">As low as</span>
                                            <div class="d-flex gap-4 align-items-center">
                                                <span class="new-price">৳{{ $product->price }}</span>
                                                <span class="old-price">৳{{ $product->regular_price }}</span>
                                            </div>
                                        </div>

                                        <div class="ec-single-stoke">
                                            <span class="ec-single-ps-title">IN STOCK</span>
                                            <span class="ec-single-sku">SKU#: {{ $product->sku }}</span>
                                        </div>
                                    </div>

                                    <div class="ec-pro-variation">
                                        <div class="ec-pro-variation-inner ec-pro-variation-size">
                                            <span>SIZE</span>
                                            <div class="ec-pro-variation-content">
                                                <ul>
                                                    @foreach($product->sizes as $size)
                                                    <li wire:click="setSelectedSize({{ $size->id }})"
                                                        class="{{ $selectedSizeId == $size->id ? 'active' : '' }}">
                                                        <span>{{ $size->name }}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="ec-pro-variation-inner ec-pro-variation-color">
                                            <span>Color</span>
                                            <div class="ec-pro-variation-content">
                                                <ul>
                                                    @foreach($product->variations as $variation)
                                                    <li wire:click="setSelectedVariation({{ $variation->id }})"
                                                        class="{{ $selectedVariationId == $variation->id ? 'active' : '' }}">
                                                        <span style="background-color: {{ $variation->color['color'] }};"></span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ec-single-qty">
                                        <div class="qty-plus-minus">
                                            <div class="ec_cart_qtybtn">
                                                <div wire:click="updateQuantity('decrement')" class="dec ec_qtybtn">-</div>
                                            </div>
                                            <input wire:model="quantity" class="qty-input" type="text" value="{{ $quantity }}" min="1" />
                                            <div class="ec_cart_qtybtn">
                                                <div wire:click="updateQuantity('increment')" class="inc ec_qtybtn">+</div>
                                            </div>
                                        </div>
                                        <div class="ec-single-cart ">
                                            <button wire:click="addToCart" class="btn btn-primary">Add To Cart</button>
                                        </div>
                                        <div class="ec-single-wishlist">
                                            <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="ec-single-social">
                                        <ul class="mb-0">
                                            <li class="list-inline-item facebook"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
                                            <li class="list-inline-item twitter"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                                            <li class="list-inline-item instagram"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
                                            <li class="list-inline-item youtube-play"><a href="#"><i class="ecicon eci-youtube-play"></i></a></li>
                                            <li class="list-inline-item behance"><a href="#"><i class="ecicon eci-behance"></i></a></li>
                                            <li class="list-inline-item whatsapp"><a href="#"><i class="ecicon eci-whatsapp"></i></a></li>
                                            <li class="list-inline-item plus"><a href="#"><i class="ecicon eci-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single product content End -->
            </div>
        </div>
    </div>
</section>
<!-- End Single product -->

<script>

</script>