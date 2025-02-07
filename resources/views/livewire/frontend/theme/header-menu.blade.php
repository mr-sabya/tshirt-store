<ul>
    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
    <li><a href="{{ route('category.index') }}" wire:navigate>Categories</a></li>
    <li><a href="{{ route('shop.index') }}" wire:navigate>Products</a></li>
    <li><a href="{{ route('custom-design.index') }}" wire:navigate>T-Shirt Builder</a></li>
    <li><a href="{{ route('offer.index') }}" wire:navigate>Hot Offers</a></li>

    <li class="scroll-to">
        <a href="javascript:void(0)">
            <i class="fi fi-rr-sort-amount-down-alt"></i>
            @if($isMobile == true)
            T-Shirt Builder
            @endif
        </a>
    </li>
</ul>