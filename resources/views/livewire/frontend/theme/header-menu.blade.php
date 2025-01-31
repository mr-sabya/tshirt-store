<ul>
    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
    <li><a href="index.html" wire:navigate>Categories</a></li>
    <li><a href="{{ route('shop.index') }}" wire:navigate>Products</a></li>
    <li><a href="{{ route('custom-design.index') }}" wire:navigate>T-Shirt Builder</a></li>
    <li><a href="offer.html" wire:navigate>Hot Offers</a></li>

    @if($isMobile == false)
    <li class="dropdown scroll-to"><a href="javascript:void(0)"><i
                class="fi fi-rr-sort-amount-down-alt"></i></a>
        <ul class="sub-menu">
            <li class="menu_title">Scroll To Section</li>
            <li><a href="javascript:void(0)" data-scroll="collection" class="nav-scroll">Top
                    Collection</a></li>
            <li><a href="javascript:void(0)" data-scroll="categories"
                    class="nav-scroll">Categories</a></li>
            <li><a href="javascript:void(0)" data-scroll="offers"
                    class="nav-scroll">Offers</a></li>
            <li><a href="javascript:void(0)" data-scroll="vendors" class="nav-scroll">Top
                    Vendors</a></li>
            <li><a href="javascript:void(0)" data-scroll="services"
                    class="nav-scroll">Services</a></li>
            <li><a href="javascript:void(0)" data-scroll="arrivals" class="nav-scroll">New
                    Arrivals</a></li>
            <li><a href="javascript:void(0)" data-scroll="reviews" class="nav-scroll">Client
                    Review</a></li>
            <li><a href="javascript:void(0)" data-scroll="insta"
                    class="nav-scroll">Instagram Feed</a></li>
        </ul>
    </li>
    @endif
</ul>