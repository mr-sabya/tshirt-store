<a href="{{ route('user.wishlist') }}" wire:navigate class="ec-header-btn ec-header-wishlist">
    <div class="header-icon"><i class="fi-rr-heart"></i></div>
    <span class="ec-header-count">{{ $wishlistItems }}</span>
</a>