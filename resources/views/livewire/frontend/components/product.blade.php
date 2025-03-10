<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
    <div class="ec-product-inner ec-product-cbb">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="product-left-sidebar.html" class="image">
                    @if($data_image)
                    <img class="main-image" src="{{ $data_image }}" alt="Product" />
                    @else
                    <img class="main-image" src="{{ url('storage/'. $product->image) }}" alt="Product" />
                    @endif

                    @if($data_image_hover)
                    <img class="hover-image" src="{{ $data_image_hover }}" alt="Product" />
                    @else
                    <img class="hover-image" src="{{ url('storage/'. $product->image) }}" alt="Product" />
                    @endif
                </a>


                @if($product->discount != null)
                <span class="percentage">{{ (int)$product->discount }}%</span>
                @endif
                <span class="flags">
                    <span class="new">New</span>
                </span>

                @if($product->is_stock == 0)
                <span class="flags">
                    <span class="sale">Sold</span>
                </span>
                @endif

                <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="quickview" title="Quick view">
                    <i class="fi-rr-eye"></i>
                </a>
                <div class="ec-pro-actions">
                    <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                    <button title="Add To Cart" class="add-to-cart" wire:click="addToCart"><i class="fi-rr-shopping-basket"></i></button>
                    <button wire:click="addToWishlist" class="ec-btn-group wishlist {{ $isInWishlist ? 'active disabled' : '' }}" title="Wishlist"><i class="fi-rr-heart"></i></button>
                </div>
            </div>
        </div>
        <div class="ec-pro-content ec-product-body">
            <ul class="ec-rating">
                <li class="ecicon eci-star fill"></li>
                <li class="ecicon eci-star fill"></li>
                <li class="ecicon eci-star fill"></li>
                <li class="ecicon eci-star fill"></li>
                <li class="ecicon eci-star"></li>
            </ul>
            <h5 class="ec-pro-title"><a href="{{ route('product.show', $product->slug) }}" wire:navigate>{{ $product->name }}</a></h5>
            <div class="ec-pro-list-desc">{{ $product->short_desc }}</div>
            <span class="ec-price">
                <span class="new-price">৳{{ $product->regular_price }}</span>
                <span class="old-price">৳{{ $product->price }}</span>
            </span>
            <div class="ec-pro-option">
                <div class="ec-pro-color">
                    <span class="ec-pro-opt-label">Color</span>
                    <ul class="ec-opt-swatch ec-change-img">
                        @foreach($product->variations as $variation)
                        <li class="{{ $variation->id == $selectedVariationId ? 'active' : '' }}" wire:click="setSelectedVariation({{ $variation->id }})">
                            <a href="javascript:void(0)" class="ec-opt-clr-img"
                                data-tooltip="{{ $variation->color['color'] }}">
                                <span style="background-color: {{ $variation->color['color'] }};"></span>
                            </a>
                            <input type="hidden" wire:model="data_image" value="{{ url('storage/'. $variation->image) }}">
                            <input type="hidden" wire:model="data_image_hover" value="{{ url('storage/'. $variation->image) }}">
                        </li>
                        @endforeach
                    </ul>

                </div>
                <div class="ec-pro-size">
                    <span class="ec-pro-opt-label">Size</span>
                    <ul class="ec-opt-size">
                        @foreach($product->sizes as $size)
                        <li class="{{ $size->id == $selectedSizeId ? 'active' : '' }}" wire:click="setSelectedSize({{ $size->id }})">
                            <a href="javascript:void(0)" class="ec-opt-sz">{{ $size->name }}</a>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        if (!window.pixelEventListenerAdded) {
            window.pixelEventListenerAdded = true; // Flag to prevent adding it again
            Livewire.on('pixelEvent', (data) => {
                console.log('Pixel Event:', data); // Check the event data
                fbq('track', data.event, data.data);
            });
        }
    });
</script>