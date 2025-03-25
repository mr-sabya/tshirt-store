<section class="section ec-services-section section-space-p" id="services">
    <h2 class="d-none">Services</h2>
    <div class="container">
        <div class="row">

            @foreach($services as $service)
            <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>{{ $service->title }}</h2>
                        <p>{{ $service->text }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-badge-percent"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>30 Days Return</h2>
                        <p>Simply return it within 30 days for an exchange</p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-donate"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>Payment Secure</h2>
                        <p>Contact us 24 hours a day, 7 days a week</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>