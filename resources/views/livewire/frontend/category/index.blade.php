<!-- START Product Transparent Style -->
<section class="sec-tp el-prod section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">categories</h2>
                    <h2 class="ec-title">categories</h2>
                    <p class="sub-title">Browse The Collection of Top Categories</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($categories as $category)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <!-- START single card -->
                <div class="ec-product-tp">
                    <div class="ec-product-image">
                        <a href="{{ route('shop.index') }}?category={{ $category->slug }}" wire:navigate>
                            <img src="{{ url('uploads/', $category->image) }}" class="img-center" alt="">
                        </a>
                    </div>
                    <div class="ec-product-body">
                        <h3 class="ec-title"><a href="#">{{ $category->name }}</a></h3>
                        <p class="ec-description">
                           {{ $category->products->count()}} Products
                        </p>
                    </div>

                </div>
                <!-- START single card -->
            </div>
            @empty
            <div class="col-lg-12">
                <div class="ec-product-tp">
                    <p>No Category Found!!</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</section>
<!--/END Product Default Style -->