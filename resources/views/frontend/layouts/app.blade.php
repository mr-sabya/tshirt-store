<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Look Up - Look up your style here</title>
    <meta name="keywords"
        content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">

    <!-- site Favicon -->
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon/favicon.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('assets/frontend/images/favicon/favicon.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/frontend/images/favicon/favicon.png') }}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor/ecicons.min.css') }}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/countdownTimer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/nouislider.css') }}" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/demo1.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}" />

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend/css/backgrounds/bg-4.css') }}" />

    @livewireStyles
</head>

<body x-data="{ loading: true }" x-init="loading = false">
    <div id="ec-overlay" x-show="loading" wire:loading>
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Header start  -->
    <livewire:frontend.theme.header />
    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">My Cart</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{ url('assets/frontend/images/product-image/6_1.jpg') }}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">T-shirt For Women</a>
                            <span class="cart-price"><span>$76.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{ url('assets/frontend/images/product-image/12_1.jpg') }}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">Women Leather Shoes</a>
                            <span class="cart-price"><span>$64.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{ url('assets/frontend/images/product-image/3_1.jpg') }}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">Girls Nylon Purse</a>
                            <span class="cart-price"><span>$59.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-left">Sub-Total :</td>
                                <td class="text-right">$300.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">VAT (20%) :</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">Total :</td>
                                <td class="text-right primary-color">$360.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_btn">
                    <a href="cart.html" class="btn btn-primary">View Cart</a>
                    <a href="checkout.html" class="btn btn-secondary">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ekka Cart End -->



    @yield('content')


    <!-- Footer Start -->
    <livewire:frontend.theme.footer />
    <!-- Footer Area End -->

    <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_1.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_2.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_3.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_4.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_5.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_1.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_2.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_3.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_4.jpg') }}" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="{{ url('assets/frontend/images/product-image/3_5.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html">Handbag leather purse for
                                        women</a>
                                </h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>

                                <div class="ec-quickview-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s,</div>
                                <div class="ec-quickview-price">
                                    <span class="old-price">$100.00</span>
                                    <span class="new-price">$80.00</span>
                                </div>

                                <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>Color</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <li><span style="background-color:#ebbf60;"></span></li>
                                                <li><span style="background-color:#75e3ff;"></span></li>
                                                <li><span style="background-color:#11f7d8;"></span></li>
                                                <li><span style="background-color:#acff7c;"></span></li>
                                                <li><span style="background-color:#e996fa;"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <span>Size</span>
                                        <div class="ec-pro-variation-content">
                                            <ul class="ec-opt-size">
                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                        data-tooltip="Small">S</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Medium">M</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Large">X</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Extra Large">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-primary"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <!-- Footer navigation panel for responsive display -->
    <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                            class="fi-rr-menu-burger"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                            class="fi-rr-shopping-bag"></i><span
                            class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="index.html" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-heart"></i><span
                            class="ec-cart-noti">4</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer navigation panel for responsive display end -->



    <!-- Vendor JS -->
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/popper.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/bootstrap.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/modernizr-3.11.2.min.js') }}"></script>

    <!--Plugins JS-->
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/swiper-bundle.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/countdownTimer.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/scrollup.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/jquery.zoom.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/slick.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/infiniteslidev2.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/frontend/js/plugins/nouislider.js') }}"></script>

    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17/dist/interact.min.js"></script>



    <!-- Main Js -->
    <script data-navigate-once src="{{ asset('assets/frontend/js/main.js') }}"></script>

    @yield('scripts')

    @livewireScripts
</body>

</html>