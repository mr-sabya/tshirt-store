<!-- Track Order Content Start -->
<div class="ec-trackorder-content col-md-12">
    <div class="ec-trackorder-inner">
        <div class="ec-trackorder-top">
            <h2 class="ec-order-id">order #6152</h2>
            <div class="ec-order-detail">
                <div>Expected arrival 14-02-2021-2022</div>
                <div>Grasshoppers <span>v534hb</span></div>
            </div>
        </div>
        <div class="ec-trackorder-bottom">
            <div class="ec-progress-track">
                <ul id="ec-progressbar">
                    <!-- Processed -->
                    <li class="step0 {{ in_array($order->status, ['processing', 'designing', 'printing', 'shipped', 'delivered']) ? 'active' : '' }}">
                        <span class="ec-track-icon">
                            <img src="{{ url('assets/frontend/images/icons/track_1.png') }}" alt="track_order">
                        </span>
                        <span class="ec-progressbar-track"></span>
                        <span class="ec-track-title">Order <br>Processed</span>
                    </li>

                    <!-- Designing -->
                    <li class="step0 {{ in_array($order->status, ['designing', 'printing', 'shipped', 'delivered']) ? 'active' : '' }}">
                        <span class="ec-track-icon">
                            <img src="{{ url('assets/frontend/images/icons/track_2.png') }}" alt="track_order">
                        </span>
                        <span class="ec-progressbar-track"></span>
                        <span class="ec-track-title">Designing</span>
                    </li>

                    <!-- Printing -->
                    <li class="step0 {{ in_array($order->status, ['printing', 'shipped', 'delivered']) ? 'active' : '' }}">
                        <span class="ec-track-icon">
                            <img src="{{ url('assets/frontend/images/icons/track_3.png') }}" alt="track_order">
                        </span>
                        <span class="ec-progressbar-track"></span>
                        <span class="ec-track-title">Printing</span>
                    </li>

                    <!-- Shipped -->
                    <li class="step0 {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : '' }}">
                        <span class="ec-track-icon">
                            <img src="{{ url('assets/frontend/images/icons/track_4.png') }}" alt="track_order">
                        </span>
                        <span class="ec-progressbar-track"></span>
                        <span class="ec-track-title">Shipped</span>
                    </li>

                    <!-- Delivered -->
                    <li class="step0 {{ $order->status == 'delivered' ? 'active' : '' }}">
                        <span class="ec-track-icon">
                            <img src="{{ url('assets/frontend/images/icons/track_5.png') }}" alt="track_order">
                        </span>
                        <span class="ec-progressbar-track"></span>
                        <span class="ec-track-title">Delivered</span>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!-- Track Order Content end -->