<!-- Start Offer section -->
<section class="labels section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Hot Offers</h2>
                    <h2 class="ec-title">Hot Offers</h2>
                    <p class="sub-title">Don't miss the chance to get best offer!!!</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($offers as $offer)
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 margin-b-30">
                <div class="ec-offer-coupon">
                    <div class="ec-cpn-brand">
                        <img class="ec-brand-img" src="{{ url('storage/', $offer->image) }}" alt="" />
                    </div>
                    <div class="ec-cpn-title">
                        <h2 class="coupon-title">{{ $offer->title }}</h2>
                    </div>
                    <div class="ec-cpn-desc">
                        <p class="coupon-text">{{ $offer->text }}</p>
                    </div>
                    <div class="ec-cpn-code">
                        <a href="{{ route('product.show', $offer->product['slug']) }}" wire:navigate class="btn btn-secondary">Shop Now</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 margin-b-30">
                <div class="ec-offer-coupon">
                    <div class="ec-cpn-title m-0">
                        <h2 class="coupon-title m-0">No Offer Founds!</h2>
                    </div>
                </div>
            </div>
            @endforelse

            {{ $offers->links() }}
        </div>
    </div>
</section>
<!-- End Offer section -->