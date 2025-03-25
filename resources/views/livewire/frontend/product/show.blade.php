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
                                            <img class="img-responsive" src="{{ url('storage/'. $product->image) }}"
                                                alt="">
                                        </div>
                                        @if($product->variations->count() > 0)
                                        @foreach($product->variations as $variation)
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive" src="{{ url('storage/'. $variation->image) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach($product->images as $image)
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive" src="{{ url('storage/'. $image->image_path) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="single-nav-thumb">
                                        <div class="single-slide">
                                            <img class="img-responsive" src="{{ url('storage/'. $product->image) }}"
                                                alt="">
                                        </div>
                                        @if($product->variations->count() > 0)
                                        @foreach($product->variations as $variation)
                                        <div class="single-slide">
                                            <img class="img-responsive" src="{{ url('storage/'. $variation->image) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach($product->images as $image)
                                        <div class="single-slide">
                                            <img class="img-responsive" src="{{ url('storage/'. $image->image_path) }}"
                                                alt="">
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="single-pro-desc single-pro-desc-no-sidebar">
                                <div class="single-pro-content">
                                    <h5 class="ec-single-title">{{ $product->name }}</h5>
                                    <div class="ec-single-rating-wrap">
                                        <div class="ec-single-rating">
                                            @php
                                            $averageRating = $product->averageRating(); // Get the average rating
                                            $fullStars = floor($averageRating); // Full stars
                                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0; // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Empty stars
                                            @endphp

                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <i class="ecicon eci-star fill"></i> <!-- Full star -->
                                                @endfor

                                                @if ($halfStar)
                                                <i class="ecicon eci-star-half"></i> <!-- Half star -->
                                                @endif

                                                @for ($i = 1; $i <= $emptyStars; $i++)
                                                    <i class="ecicon eci-star-o"></i> <!-- Empty star -->
                                                    @endfor
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
                                                <span class="old-price" style="text-decoration: line-through;">৳{{ $product->regular_price }}</span>
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
                                                    @if($product->variations->count() > 0)
                                                    @foreach($product->variations as $variation)
                                                    <li wire:click="setSelectedVariation({{ $variation->id }})"
                                                        class="{{ $selectedVariationId == $variation->id ? 'active' : '' }}">
                                                        <span style="background-color: {{ $variation->color['color'] }};"></span>
                                                    </li>
                                                    @endforeach
                                                    @else
                                                    <li class="active">
                                                        <span style="background-color: {{ $product->color['color'] }};"></span>
                                                    </li>
                                                    @endif
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
                                            <button wire:click="addToCart" class="btn btn-primary" {{ $isProductStock ? '' : 'disabled'}}>
                                                {{ $isProductStock ? 'Add to Cart' : 'Out of Stock'}}
                                            </button>
                                        </div>

                                        <div class="ec-single-cart">
                                            <button wire:click="buyNow" class="btn btn-primary ms-0" {{ $isProductStock ? '' : 'disabled'}}>
                                                {{ $isProductStock ? 'Order Now' : 'Out of Stock'}}
                                            </button>
                                        </div>
                                        <div class="ec-single-wishlist">
                                            <button wire:click="addToWishlist" class="ec-btn-group wishlist {{ $isInWishlist ? 'active disabled' : '' }}" title="Wishlist"><i class="fi-rr-heart"></i></button>
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
                <!-- Single product tab start -->
                <div class="ec-single-pro-tab">
                    <div class="ec-single-pro-tab-wrapper">
                        <div class="ec-single-pro-tab-nav">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#ec-spt-nav-details" role="tab" aria-controls="ec-spt-nav-details" aria-selected="true">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                        role="tab" aria-controls="ec-spt-nav-info" aria-selected="false">More Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                        role="tab" aria-controls="ec-spt-nav-review" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content  ec-single-pro-tab-content">
                            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                <div class="ec-single-pro-tab-desc">
                                    {!! $product->details !!}
                                </div>
                            </div>
                            <div id="ec-spt-nav-info" class="tab-pane fade">
                                <div class="ec-single-pro-tab-moreinfo">
                                    <ul>
                                        @foreach($product->infos as $info)
                                        <li><span>{{ $info->key }}</span> {{ $info->value}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div id="ec-spt-nav-review" class="tab-pane fade">
                                <livewire:frontend.product.rating product_id="{{ $product->id }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Single product -->

<script>
    document.addEventListener('livewire:init', function() {
        Livewire.on('addToCartPixel', (data) => {
            if (typeof fbq !== 'undefined') {
                fbq('track', 'AddToCart', {
                    content_ids: [data.product_id],
                    content_name: data.name,
                    value: data.price * data.quantity,
                    currency: data.currency,
                    quantity: data.quantity
                });
                console.log("Facebook Pixel AddToCart event fired", data);
            }
        });
    });
</script>