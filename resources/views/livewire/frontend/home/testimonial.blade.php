<section class="section ec-test-section section-space-ptb-100 section-space-m mb-0" id="reviews">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title mb-0">
                    <h2 class="ec-bg-title">Testimonial</h2>
                    <h2 class="ec-title">Client Review</h2>
                    <p class="sub-title mb-3">What say client about us</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ec-test-outer">
                <ul id="ec-testimonial-slider">
                    @foreach($testimonials as $testimonial)
                    <li class="ec-test-item">
                        <i class="fi-rr-quote-right top"></i>
                        <div class="ec-test-inner">
                            <div class="ec-test-img">
                                <img alt="testimonial" title="testimonial"
                                    src="{{ asset('storage/' . $testimonial->image) }}" />
                            </div>
                            <div class="ec-test-content">
                                <div class="ec-test-desc">{{ $testimonial->review }}</div>
                                <div class="ec-test-name">{{ $testimonial->name }}</div>
                                <div class="ec-test-designation">{{ $testimonial->position }}</div>
                                <div class="ec-test-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="ecicon eci-star {{ $i < $testimonial->rating ? 'fill' : '' }}"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <i class="fi-rr-quote-right bottom"></i>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>