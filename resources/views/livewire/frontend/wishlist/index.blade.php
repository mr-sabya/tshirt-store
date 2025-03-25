<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            @if($wishlistItems->count() > 0)
            <div class="ec-cart-leftside col-lg-12 ">
                <!-- wishlist content Start -->
                <div class="ec-cart-content">
                    <div class="ec-cart-inner">
                        <div class="row">
                            <div class="table-content cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wishlistItems as $item)
                                        <tr>
                                            <td data-label="Product" class="ec-cart-pro-name">
                                                <a href="{{ route('product.show', $item->product->id) }}">
                                                    <div class="d-flex align-items-center">
                                                        @if($item->variation)
                                                        <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $item->variation->image ?? $item->product->image) }}" alt="{{ $item->product['name'] }}" />
                                                        @else
                                                        <img class="ec-cart-pro-img mr-4" src="{{ url('storage/'. $item->product->image) }}" alt="{{ $item->product['name'] }}" />
                                                        @endif
                                                        <div>
                                                            <p class="m-0">{{ $item->product->name }}</p>
                                                            @if($item->size)
                                                            <p class="m-0 {{ $item->product->getSizeStock($item->size['id']) ? 'text-success' : 'text-danger' }}">
                                                                {{ $item->product->getSizeStock($item->size['id']) ? 'In Stock' : 'Out of Stock' }}
                                                            </p>
                                                            @else
                                                            <p class="m-0 {{ $item->product->is_stock ? 'text-success' : 'text-danger' }}">
                                                                {{ $item->product->is_stock ? 'In Stock' : 'Out of Stock' }}
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td data-label="Price" class="ec-cart-pro-price">
                                                <span class="amount">৳ {{ $item->product->price }}</span>
                                            </td>
                                        

                                            <td>
                                                <button class="btn btn-primary" wire:click="moveToCart({{ $item->id }})" type="button">Move to Cart</button>
                                                <button class="btn btn-warning" wire:click="buyNow({{ $item->id }})" type="button">Buy Now</button>
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
                                        <a href="{{ route('shop.index') }}" wire:navigate>Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wishlist content End -->
            </div>

            <!-- Sidebar Area Start -->

            @else
            <div class="col-lg-12">
                <div class="ec-cart-inner empty-cart-page">
                    <img src="{{ url('assets/frontend/images/11329060.png') }}" alt="">
                    <p>No Items in your Wishlist</p>
                    <div class="ec-cart-update-bottom">
                        <a href="{{ route('shop.index') }}" wire:navigate>Continue Shopping</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

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