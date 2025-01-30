<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="product-left-sidebar.html" class="image">
                    <img class="main-image"
                        src="{{ url('storage', $product->image) }}" alt="Product" />
                    <img class="hover-image"
                        src="{{ url('storage', $product->image) }}" alt="Product" />
                </a>
                @if($product->discount != null)
                <span class="percentage">{{ (int)$product->discount }}%</span>
                @endif
                <span class="flags">
                    <span class="new">New</span>
                </span>
                <span class="flags">
                    <span class="sale">Sale</span>
                </span>

                <a href="#" class="quickview" data-link-action="quickview"
                    title="Quick view" data-bs-toggle="modal"
                    data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                <div class="ec-pro-actions">
                    <a href="compare.html" class="ec-btn-group compare"
                        title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                    <button title="Add To Cart" class="add-to-cart"><i
                            class="fi-rr-shopping-basket"></i> Add To Cart</button>
                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                            class="fi-rr-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="ec-pro-content">
            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">{{ $product->name }}</a></h5>
            <div class="ec-pro-rating">
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star fill"></i>
                <i class="ecicon eci-star"></i>
            </div>
            <div class="ec-pro-list-desc">{{ $product->short_desc }}</div>
            <span class="ec-price">
                <span class="old-price">৳{{ $product->regular_price }}</span>
                <span class="new-price">৳{{ $product->price }}</span>
            </span>
            <div class="ec-pro-option">
                <div class="ec-pro-color">
                    <span class="ec-pro-opt-label">Color</span>
                    <ul class="ec-opt-swatch ec-change-img">
                        @foreach($product->variations as $variation)
                        <li class="{{ $loop->first ? 'active' : '' }}"><a href="javascript:void(0)" class="ec-opt-clr-img"
                                data-src="{{ url('storage', $variation->image) }}"
                                data-src-hover="{{ url('storage', $variation->image) }}"
                                data-tooltip="Gray"><span
                                    style="background-color: {{ $variation->color['color'] }};"></span></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="ec-pro-size">
                    <span class="ec-pro-opt-label">Size</span>
                    <ul class="ec-opt-size">
                        @foreach($product->sizes as $size)
                        <li class="active"><a href="javascript:void(0)" class="ec-opt-sz"
                                data-tooltip="Small">{{ $size->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>