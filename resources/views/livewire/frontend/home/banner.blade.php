<div class="sticky-header-next-sec ec-main-slider section section-space-pb">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
        <!-- Main slider -->
        <div class="swiper-wrapper">
            @forelse($banners as $banner)
            <div class="ec-slide-item swiper-slide d-flex banner-bg" data-bg="{{ asset('storage/' . $banner->image) }}">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title">New Fashion Collection</h1>
                                <h2 class="ec-slide-stitle">Sale Offer</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title">New Fashion Collection</h1>
                                <h2 class="ec-slide-stitle">Sale Offer</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>