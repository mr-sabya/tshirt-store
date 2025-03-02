<div class="ec-sidebar-wrap ec-border-box">
    <!-- Sidebar Category Block -->
    <div class="ec-sidebar-block">
        <div class="ec-vendor-block">
            <!-- <div class="ec-vendor-block-bg"></div>
                                <div class="ec-vendor-block-detail">
                                    <img class="v-img" src="assets/images/user/1.jpg" alt="vendor image">
                                    <h5>Mariana Johns</h5>
                                </div> -->
            <div class="ec-vendor-block-items">
                <ul>
                    <li><a href="{{ route('user.profile') }}" wire:navigate>User Profile</a></li>
                    <li><a href="{{ route('history.index') }}" wire:navigate>History</a></li>
                    <li><a href="{{ route('user.design.index') }}" wire:navigate>Designs</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li><a href="track-order.html">Track Order</a></li>
                    <li><a href="user-invoice.html">Invoice</a></li>
                    <livewire:frontend.user.logout />
                </ul>
            </div>
        </div>
    </div>
</div>