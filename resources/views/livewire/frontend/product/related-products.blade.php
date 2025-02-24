<section class="section ec-product-tab section-space-p" id="collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Related products</h2>
                    <h2 class="ec-title">Related products</h2>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Product Content -->
            @foreach($products as $product)
            <livewire:frontend.components.product productId="{{ $product->id }}" />
            @endforeach

            <div class="col-sm-12 shop-all-btn"><a href="shop-left-sidebar-col-3.html">Shop All
                    Collection</a></div>
        </div>
    </div>
</section>