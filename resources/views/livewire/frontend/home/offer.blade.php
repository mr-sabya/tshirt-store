<section class="section ec-offer-section section-space-p section-space-m" style="background-image: url({{ url('storage/' . $offer->background_image) }});">
    <h2 class="d-none">Offer</h2>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center ec-offer-content">
                <h2 class="ec-offer-title">{{ $offer->product_name }}</h2>
                <h3 class="ec-offer-stitle" data-animation="slideInDown">{{ $offer->offer_text }}</h3>
                <span class="ec-offer-img" data-animation="zoomIn"><img src="{{ url('assets/frontend/images/offer-image/1.png') }}"
                        alt="offer image" /></span>
                <span class="ec-offer-desc">{{ $offer->offer_description }}</span>
                <span class="ec-offer-price">৳{{ $offer->product['price']}} Only</span>
                <a class="btn btn-primary" href="{{ route('product.show', $offer->product['slug']) }}" wire:navigate data-animation="zoomIn">Shop Now</a>
            </div>
        </div>
    </div>
</section>