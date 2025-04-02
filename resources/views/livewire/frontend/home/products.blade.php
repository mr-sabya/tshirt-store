<section class="section ec-product-tab section-space-p" id="collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Our Top Collection</h2>
                    <h2 class="ec-title">Our Top Collection</h2>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="action d-flex align-items-center justify-content-center gap-2 mb-4">
                @foreach($categories as $category)
                <button class="btn  {{ $categoryId == $category->id ? 'btn-primary' : 'btn-light' }}"
                    wire:click="getCategoryId({{ $category->id }})">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
            <!-- Product Content -->
            <div class="row">
                @if($products && count($products) > 0)
                @foreach($products as $product)
                <livewire:frontend.components.product :productId="$product->id" wire:key="product-{{ $product->id }}" />
                @endforeach
                @else
                <h4 class="text-center mb-5">No products found in this category.</h4>
                @endif
            </div>
            <div class="col-sm-12 shop-all-btn">
                <a href="{{ route('shop.index') }}" wire:navigate>Shop All Collection</a>
            </div>
        </div>
    </div>
</section>
