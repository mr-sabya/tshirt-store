<div class="header-search">
    <form wire:submit.prevent="updatedQuery">
        <input class="form-control ec-search-bar" type="text" wire:model.live="query" placeholder="Search products..." />
        <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
    </form>

    @if($query)
    <div class="search-results">
        @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-12">
                <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="w-100">
                    <div class="product-card">
                        <img src="{{ url('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="text">
                            <h5 class="m-0">{{ $product->name }}</h5>
                            <p class="m-0">{{ \Illuminate\Support\Str::limit($product->short_desc, 50) }}</p>
                            <p class="m-0">৳ {{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p>No products found for your search.</p>
        @endif

        <div class="mt-2">
            <a class="show-all" href="{{ route('shop.index') }}" wire:navigate>Show All Products</a>
        </div>
    </div>
    @endif
</div>