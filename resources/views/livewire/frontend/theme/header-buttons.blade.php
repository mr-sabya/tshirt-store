<div class="ec-header-bottons">

    <!-- Header User Start -->
    @auth
    <a href="{{ route('user.profile') }}" wire:navigate class="ec-header-user">
        <div class="header-icon"><i class="fi-rr-user"></i></div>
    </a>
    @else
    <a href="{{ route('login') }}" wire:navigate class="ec-header-user">
        <div class="header-icon"><i class="fi-rr-user"></i></div>
    </a>
    @endauth
    <!-- Header User End -->

    @auth
    <!-- Header wishlist Start -->
    <livewire:frontend.theme.wishlist-button />
    
    <!-- Header wishlist End -->
    <!-- Header Cart Start -->
    <livewire:frontend.theme.cart-button />
    @endauth

    @if($isMobile == true)
    <!-- Header Cart End -->
    <!-- <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
        <i class="fi fi-rr-apps"></i>
    </a> -->
    <!-- Header menu Start -->
    <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
        <i class="fi fi-rr-menu-burger"></i>
    </a>
    <!-- Header menu End -->
    @endif
</div>