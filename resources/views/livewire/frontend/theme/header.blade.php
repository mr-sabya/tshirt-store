<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top social Start -->
                <div class="col text-left header-top-left d-none d-lg-block">
                    <div class="header-top-social">
                        <span class="social-text text-upper">Follow us on:</span>
                        <x-social />
                    </div>
                </div>
                <!-- Header Top social End -->
                <!-- Header Top Message Start -->
                <div class="col text-right header-top-center">
                    <div class="header-top-message text-upper">
                        {{ $settings['top_header_text'] }}
                    </div>
                </div>
                <!-- Header Top Message End -->

                <!-- Header Top responsive Action -->
                <div class="col d-lg-none ">
                    <livewire:frontend.theme.header-buttons isMobile="true" />
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('home') }}" wire:navigate>
                                @if($settings['logo'])
                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Site Logo" />
                                @else
                                <img src="{{ url('assets/frontend/images/logo/logo.png') }}" alt="Site Logo" />
                                @endif
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        <livewire:frontend.theme.header-search />
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <livewire:frontend.theme.header-buttons />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="index.html">
                            @if($settings['logo'])
                            <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Site Logo" />
                            @else
                            <img src="{{ url('assets/frontend/images/logo/logo.png') }}" alt="Site Logo" />
                            @endif
                        </a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col">
                    <livewire:frontend.theme.header-search />
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">
                        <!-- <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <i class="fi fi-rr-apps"></i>
                        </a> -->
                        <livewire:frontend.theme.header-menu />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <livewire:frontend.theme.header-menu isMobile="true" />
            </div>

        </div>
    </div>
    <!-- ekka mobile Menu End -->
</header>