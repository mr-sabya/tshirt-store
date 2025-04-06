<footer class="ec-footer">
    <div class="footer-container">
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 ec-footer-contact">
                        <div class="ec-footer-widget">
                            <div class="ec-footer-logo">
                                <a href="#">
                                    @if($settings['footer_logo'])
                                    <img src="{{ asset('storage/' . $settings['footer_logo']) }}" alt="">
                                    @else
                                    <img src="{{ url('assets/frontend/images/logo/footer-logo.png') }}"
                                        alt="">
                                    @endif
                                    <!-- <img class="dark-footer-logo" src="{{ url('assets/frontend/images/logo/dark-logo.png') }}"
                                        alt="Site Logo" style="display: none;" /> -->
                                </a>
                            </div>
                            <h4 class="ec-footer-heading">Contact us</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">{{ $settings['address']}}</li>
                                    <li class="ec-footer-link"><span>Call Us:</span><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></li>
                                    <li class="ec-footer-link"><span>Email:</span><a
                                            href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-info">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Information</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.about') }}" name="About Us" />
                                    </li>
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.faq') }}" name="FAQ" />
                                    </li>
                                    <li class="ec-footer-link">
                                        <x-link link="#" name="Delivery Information" />
                                    </li>
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.contact') }}" name="Contact Us" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Top Categories</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    @foreach ($categories as $category)
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('shop.index') }}?category={{ $category->slug }}" wire:navigate name="{{ $category->name }}" />
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Services</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="track-order.html">Discount Returns</a></li>
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.privacy') }}" name="Privacy & Policy" />
                                    </li>
                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.refund') }}" name="Refund Policy" />
                                    </li>

                                    <li class="ec-footer-link">
                                        <x-link link="{{ route('page.terms') }}" name="Term & condition" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-news">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Newsletter</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">{{ $settings['newsletter_text'] }}</li>
                                </ul>
                                <div class="ec-subscribe-form">
                                    <form id="ec-newsletter-form" name="ec-newsletter-form" method="post"
                                        action="#">
                                        <div id="ec_news_signup" class="ec-form">
                                            <input class="ec-email" type="email" required=""
                                                placeholder="Enter your email here..." name="ec-email" value="" />
                                            <button id="ec-news-btn" class="button btn-primary" type="submit"
                                                name="subscribe" value=""><i class="ecicon eci-paper-plane-o"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Footer social Start -->
                    <div class="col text-left footer-bottom-left">
                        <div class="footer-bottom-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <x-social />
                        </div>
                    </div>
                    <!-- Footer social End -->
                    <!-- Footer Copyright Start -->
                    <div class="col text-center footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">{!! $settings['copyright_text'] !!}</div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->
                    <!-- Footer payment -->
                    <div class="col footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">
                            <div class="payment-link">
                                <img src="{{ url('assets/frontend/images/icons/payment.png') }}" alt="">
                            </div>

                        </div>
                    </div>
                    <!-- Footer payment -->
                </div>
            </div>
        </div>
    </div>
</footer>