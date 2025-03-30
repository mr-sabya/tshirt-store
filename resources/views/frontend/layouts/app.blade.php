<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    @if(Route::is('home'))
    <title>{{ $settings['site_name'] ?? 'Default Site Name' }} - {{ $settings['tagline']}}</title>
    @else
    <title>@yield('title') - {{ $settings['site_name']}}</title>
    @endif

    @if(Route::currentRouteName() == 'product.show')
    <!-- insert seo -->
    @yield('seo')
    <!-- insert seo -->
    @else
    <meta name="title" content="{{ $settings->meta_title }}" />
    <meta name="keywords" content="{{ $settings->meta_keywords }}" />
    <meta name="description" content="{{ $settings->meta_description }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $settings['og_title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $settins['og_description'] ?? 'Your default description' }}">
    <meta property="og:image" content="{{ asset('storage/' . ($settins['og_image'] ?? 'default-image.jpg')) }}">
    <meta property="og:type" content="{{ $settins['og_type'] ?? 'website' }}">
    <!-- Add other Open Graph tags as needed -->

    @endif
    <link rel="canonical" href="{{ $settings['canonical_url'] ?? url()->current() }}">

    <!-- site Favicon -->
    @if($settings->favicon)
    <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $settings->favicon) }}" />
    <meta name="msapplication-TileImage" content="{{ asset('storage/' . $settings->favicon) }}" />
    @else
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon/favicon.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('assets/frontend/images/favicon/favicon.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/frontend/images/favicon/favicon.png') }}" />
    @endif

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor/ecicons.min.css') }}" />
    <!-- Include Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

    <!-- Meta Pixel Code -->
    <script data-navigate-once>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1096595042239828');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1096595042239828&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

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
    <livewire:frontend.theme.cart />
    <!-- ekka Cart End -->



    @yield('content')


    <!-- Footer Start -->
    <livewire:frontend.theme.footer />
    <!-- Footer Area End -->



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

    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js"></script>

    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17/dist/interact.min.js"></script>



    <!-- Main Js -->
    <script data-navigate-once src="{{ asset('assets/frontend/js/main.js') }}"></script>

    @yield('scripts')

    @livewireScripts
</body>

</html>