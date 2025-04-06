<div class="banner py-4" style="background-color: rgb(235 235 235/var(--tw-bg-opacity,1));">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 banner-left">
                <div class="sticky-header-next-sec ec-main-slider section">
                    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
                        <!-- Main slider -->
                        <div class="swiper-wrapper">
                            @forelse($banners as $banner)
                            <div class="ec-slide-item swiper-slide d-flex banner-bg" data-bg="{{ asset('storage/' . $banner->image) }}">
                                <div class="container align-self-center">
                                    <div class="row">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 align-self-center">
                                            <div class="ec-slide-content slider-animation">
                                                <h1 class="ec-slide-title">{{ $banner->heading }}</h1>
                                                <h2 class="ec-slide-stitle">{{ $banner->offer_text }}</h2>
                                                <p>{{ $banner->text }}</p>
                                                <a href="{{ route('product.show', $banner->product['slug'])}}" wire:navigate class="btn btn-lg btn-secondary">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
                                <div class="container align-self-center">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 align-self-center">
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
            </div>
            <div class="col-lg-4 ">
                <div class="banner-right ec-page-detail">
                    <div class="ec-cat-bnr">
                        <a href="product-left-sidebar.html"><span></span></a>
                    </div>
                    <div class="ec-cat-bnr">
                        <a href="product-left-sidebar.html"><span></span></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>